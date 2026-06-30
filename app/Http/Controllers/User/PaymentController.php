<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Notifikasi;
use App\Models\Pembayaran;
use App\Models\PaketMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Midtrans\Transaction; // tambahkan di atas

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey    = config('midtrans.server_key');
        Config::$clientKey    = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized  = config('midtrans.is_sanitized');
        Config::$is3ds        = config('midtrans.is_3ds');
    }

    // ── Generate Order ID ─────────────────────────────────
    private function generateOrderId(): string
    {
        return 'SGY-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
    }

    // ── Generate Kode Member ──────────────────────────────
    private function generateNoPendaftaran(): string
    {
        $year   = date('Y');
        $prefix = "REG-{$year}";
        $last   = Member::where('noPendaftaran', 'like', "{$prefix}%")
                    ->orderBy('idMember', 'desc')->first();
        $number = $last ? (int) substr($last->noPendaftaran, -4) + 1 : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    private function generateKodeMember(): string
    {
        $last   = Member::orderBy('idMember', 'desc')->first();
        $number = $last ? (int) substr($last->kodeMember, -4) + 1 : 1;
        return 'MBR-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    // ── STEP 1: Buat Transaksi Snap Token ────────────────
    public function createTransaction(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'idPaket'          => 'required|exists:paketMember,idPaket',
            'metodePembayaran' => 'required|in:cash,qris',
        ]);

        $paket = PaketMember::findOrFail($request->idPaket);

        // Kalau cash → proses seperti sebelumnya (tanpa Midtrans)
        if ($request->metodePembayaran === 'cash') {
            return $this->prosesCash($user, $paket);
        }

        // QRIS/Online → Proses via Midtrans
        return $this->prosesOnline($user, $paket);
    }

    // ── Proses Cash ───────────────────────────────────────
    private function prosesCash($user, $paket)
    {
        $pending = Member::where('idUser', $user->id)
                        ->where('statusMember', 'tidak aktif')
                        ->whereNull('tanggalDaftar')
                        ->first();

        if ($pending) {
            $pending->update(['idPaket' => $paket->idPaket]);
        } else {
            Member::create([
                'noPendaftaran' => $this->generateNoPendaftaran(),
                'kodeMember'    => $this->generateKodeMember(),
                'idUser'        => $user->id,
                'idPaket'       => $paket->idPaket,
                'noTelp'        => $user->noTelp,
                'statusMember'  => 'tidak aktif',
                'tanggalDaftar' => null,
                'tanggalAkhir'  => null,
            ]);
        }

        Notifikasi::create([
            'judul'  => 'Pembelian Member Baru (Cash)',
            'pesan'  => "{$user->name} memilih paket {$paket->namaPaket} dengan pembayaran tunai. Mohon konfirmasi setelah pembayaran diterima.",
            'idUser' => $user->id,
            'tipe'   => 'pembelian_member',
            'isRead' => 0,
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', '✅ Permintaan terkirim! Silakan bayar ke kasir gym. Membership aktif setelah pembayaran dikonfirmasi admin.');
    }

    // ── Proses Online (Midtrans) ──────────────────────────
    private function prosesOnline($user, $paket)
    {
        $orderId = $this->generateOrderId();

        // Simpan record pembayaran
        $pembayaran = Pembayaran::create([
            'orderId'          => $orderId,
            'idUser'           => $user->id,
            'idPaket'          => $paket->idPaket,
            'jumlah'           => $paket->hargaPaket,
            'metodePembayaran' => 'online',
            'status'           => 'pending',
        ]);

        // Buat Snap Token
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => (int) $paket->hargaPaket,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email'      => $user->email,
                'phone'      => $user->noTelp ?? '',
            ],
            'item_details' => [
                [
                    'id'       => 'PKT-' . $paket->idPaket,
                    'price'    => (int) $paket->hargaPaket,
                    'quantity' => 1,
                    'name'     => $paket->namaPaket . ' (' . $paket->durasiPaket . ' hari)',
                ]
            ],
            'callbacks' => [
                'finish'  => route('user.payment.finish'),
                'error'   => route('user.payment.error'),
                'pending' => route('user.payment.pending'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            // Simpan snap token
            $pembayaran->update(['snapToken' => $snapToken]);

            return response()->json([
                'success'    => true,
                'snapToken'  => $snapToken,
                'orderId'    => $orderId,
                'clientKey'  => config('midtrans.client_key'),
                'snapUrl'    => config('midtrans.snap_url'),
            ]);

        } catch (\Exception $e) {
            Log::error('Midtrans Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal membuat transaksi. Silakan coba lagi.',
            ], 500);
        }
    }

    // ── Callback dari Midtrans (Webhook) ──────────────────
    public function callback(Request $request)
    {
        try {
            Config::$serverKey    = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');

            $notification = new Notification();

            $orderId           = $notification->order_id;
            $statusCode        = $notification->status_code;
            $grossAmount       = $notification->gross_amount;
            $transactionStatus = $notification->transaction_status;
            $paymentType       = $notification->payment_type;
            $fraudStatus       = $notification->fraud_status ?? 'accept';

            $pembayaran = Pembayaran::where('orderId', $orderId)->first();

            if (!$pembayaran) {
                Log::warning("Pembayaran tidak ditemukan: {$orderId}");
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Simpan response Midtrans
            $pembayaran->update([
                'midtransResponse' => $request->all(),
                'metodePembayaran' => $paymentType,
            ]);

            // Tentukan status berdasarkan respons Midtrans
            if ($transactionStatus === 'capture') {
                if ($fraudStatus === 'challenge') {
                    $pembayaran->update(['status' => 'challenge']);
                } elseif ($fraudStatus === 'accept') {
                    $this->aktivasiMember($pembayaran);
                }
            } elseif ($transactionStatus === 'settlement') {
                $this->aktivasiMember($pembayaran);
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $pembayaran->update(['status' => $transactionStatus]);
            } elseif ($transactionStatus === 'pending') {
                $pembayaran->update(['status' => 'pending']);
            }

            return response()->json(['message' => 'OK']);

        } catch (\Exception $e) {
            Log::error('Midtrans Callback Error: ' . $e->getMessage());
            return response()->json(['message' => 'Error'], 500);
        }
    }

    // ── Aktivasi Member Setelah Pembayaran Sukses ─────────
private function aktivasiMember(Pembayaran $pembayaran)
{
    if ($pembayaran->status === 'success') {
        return; // sudah pernah diaktivasi, jangan proses ulang
    }

    $pembayaran->update(['status' => 'success']);

    $user  = $pembayaran->user;
    $paket = $pembayaran->paket;

    $member = Member::where('idUser', $user->id)->first();

    if ($member) {
        $member->update([
            'idPaket'       => $paket->idPaket,
            'statusMember'  => 'aktif',
            'tanggalDaftar' => today()->format('Y-m-d'),
            'tanggalAkhir'  => today()->addDays($paket->durasiPaket)->format('Y-m-d'),
        ]);
    } else {
        Member::create([
            'noPendaftaran' => $this->generateNoPendaftaran(),
            'kodeMember'    => $this->generateKodeMember(),
            'idUser'        => $user->id,
            'idPaket'       => $paket->idPaket,
            'noTelp'        => $user->noTelp,
            'statusMember'  => 'aktif',
            'tanggalDaftar' => today()->format('Y-m-d'),
            'tanggalAkhir'  => today()->addDays($paket->durasiPaket)->format('Y-m-d'),
        ]);
    }

    Notifikasi::create([
        'judul'  => '✅ Pembayaran Online Berhasil',
        'pesan'  => "{$user->name} berhasil membayar paket {$paket->namaPaket} via online. Membership sudah otomatis aktif.",
        'idUser' => $user->id,
        'tipe'   => 'pembelian_member',
        'isRead' => 0,
    ]);
}
    // ── Halaman Finish / Error / Pending ─────────────────
    public function finish(Request $request)
    {
        return redirect()->route('user.dashboard')
            ->with('success', '🎉 Pembayaran berhasil! Membership kamu sudah aktif.');
    }

    public function error(Request $request)
    {
        return redirect()->route('user.dashboard')
            ->with('error', '❌ Pembayaran gagal. Silakan coba lagi atau hubungi admin.');
    }

    public function pending(Request $request)
    {
        return redirect()->route('user.dashboard')
            ->with('success', '⏳ Pembayaran sedang diproses. Membership akan aktif setelah pembayaran dikonfirmasi.');
    }

    // ── Status Pembayaran (untuk polling JS) ──────────────
// ── Status Pembayaran (untuk polling JS) ──────────────
public function checkStatus(Request $request)
{
    $orderId = $request->query('orderId');

    if (!$orderId) {
        return response()->json(['status' => 'invalid_request']);
    }

    $pembayaran = Pembayaran::where('orderId', $orderId)->first();

    if (!$pembayaran) {
        return response()->json(['status' => 'not_found']);
    }

    // Kalau status lokal belum final, tanya langsung ke Midtrans
    if (!in_array($pembayaran->status, ['success', 'cancel', 'deny', 'expire'])) {
        try {
            $status = Transaction::status($orderId);
            $status = is_array($status) ? (object) $status : $status;

            $transactionStatus = $status->transaction_status;
            $fraudStatus       = $status->fraud_status ?? 'accept';

            Log::info("checkStatus [{$orderId}] => transaction_status: {$transactionStatus}, fraud_status: {$fraudStatus}");

            if (($transactionStatus === 'capture' && $fraudStatus === 'accept')
                || $transactionStatus === 'settlement') {
                $this->aktivasiMember($pembayaran);
            } elseif (in_array($transactionStatus, ['cancel', 'deny', 'expire'])) {
                $pembayaran->update(['status' => $transactionStatus]);
            }

            $pembayaran->refresh();
        } catch (\Exception $e) {
            Log::error("checkStatus GAGAL ({$orderId}): " . $e->getMessage());
        }
    }

    return response()->json([
        'status'  => $pembayaran->status,
        'orderId' => $pembayaran->orderId,
    ]);
}
}