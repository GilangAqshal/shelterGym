<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PaketMember;
use App\Models\Notifikasi;
use App\Models\KunjunganMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
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

    private function generateInvoiceSelf(): string
    {
        $year   = date('Y');
        $prefix = "SELF-{$year}-";
        $last   = KunjunganMember::where('invoice', 'like', "{$prefix}%")
                    ->orderBy('idKunjunganMember', 'desc')->first();
        $number = $last ? (int) substr($last->invoice, -4) + 1 : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    // ── FITUR 1: Beli / Perpanjang Member ────────────────
    public function beli(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'idPaket' => 'required|exists:paketMember,idPaket',
        ], [
            'idPaket.required' => 'Paket wajib dipilih.',
        ]);

        $paket = PaketMember::findOrFail($request->idPaket);

        // Cek apakah sudah ada member pending (tidak aktif & tanggal null)
        $pending = Member::where('idUser', $user->id)
                        ->where('statusMember', 'tidak aktif')
                        ->whereNull('tanggalDaftar')
                        ->first();

        if ($pending) {
            // Update paket saja
            $pending->update(['idPaket' => $request->idPaket]);
        } else {
            // Buat record member baru
            Member::create([
                'noPendaftaran' => $this->generateNoPendaftaran(),
                'kodeMember'    => $this->generateKodeMember(),
                'idUser'        => $user->id,
                'idPaket'       => $request->idPaket,
                'noTelp'        => $user->noTelp,
                'statusMember'  => 'tidak aktif',
                'tanggalDaftar' => null,
                'tanggalAkhir'  => null,
            ]);
        }

        // Kirim notifikasi ke admin
        Notifikasi::create([
            'judul'  => 'Pembelian Member Baru',
            'pesan'  => "{$user->name} telah memilih paket {$paket->namaPaket}. Mohon segera diaktifkan.",
            'idUser' => $user->id,
            'tipe'   => 'pembelian_member',
            'isRead' => 0,
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', 'Permintaan pembelian berhasil dikirim! Tunggu konfirmasi admin.');
    }

    // ── FITUR 4: Edit Member oleh User ───────────────────
    public function edit(Request $request)
    {
        /** @var \App\Models\User $user */
        $user   = Auth::user();
        $member = Member::where('idUser', $user->id)->firstOrFail();

        $request->validate([
            'noTelp'  => 'nullable|string|max:20',
            'idPaket' => 'required|exists:paketMember,idPaket',
        ]);

        $paketBerubah = $member->idPaket != $request->idPaket;

        $updateData = [
            'noTelp'  => $request->noTelp,
            'idPaket' => $request->idPaket,
        ];

        // Jika paket berubah → reset status ke tidak aktif
        if ($paketBerubah) {
            $paket = PaketMember::findOrFail($request->idPaket);
            $updateData['statusMember']  = 'tidak aktif';
            $updateData['tanggalDaftar'] = null;
            $updateData['tanggalAkhir']  = null;

            Notifikasi::create([
                'judul'  => 'Perubahan Paket Member',
                'pesan'  => "{$user->name} mengubah paket ke {$paket->namaPaket}. Mohon diaktifkan ulang.",
                'idUser' => $user->id,
                'tipe'   => 'pembelian_member',
                'isRead' => 0,
            ]);
        }

        $member->update($updateData);

        $pesan = $paketBerubah
            ? 'Paket berhasil diubah. Tunggu konfirmasi admin untuk aktivasi.'
            : 'Data member berhasil diperbarui.';

        return redirect()->route('user.dashboard')->with('success', $pesan);
    }

    // ── FITUR 6: Check-in Mandiri ─────────────────────────
    public function checkin()
    {
        /** @var \App\Models\User $user */
        $user   = Auth::user();
        $member = Member::where('idUser', $user->id)
                    ->where('statusMember', 'aktif')
                    ->first();

        if (!$member) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Membership tidak aktif.');
        }

        $sudah = KunjunganMember::where('idMember', $member->idMember)
                    ->whereDate('tanggal', today())
                    ->exists();

        if ($sudah) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Kamu sudah check-in hari ini.');
        }

        KunjunganMember::create([
            'invoice'  => $this->generateInvoiceSelf(),
            'idMember' => $member->idMember,
            'tanggal'  => today(),
        ]);

        return redirect()->route('user.dashboard')
            ->with('success', '✅ Check-in berhasil! Selamat berlatih.');
    }

    // ── FITUR 5: Riwayat Kunjungan ───────────────────────
    public function riwayat()
    {
        /** @var \App\Models\User $user */
        $user   = Auth::user();
        $member = Member::where('idUser', $user->id)->first();

        $kunjungan = collect();
        if ($member) {
            $kunjungan = KunjunganMember::where('idMember', $member->idMember)
                            ->orderBy('tanggal', 'desc')
                            ->paginate(15);
        }

        return view('user.riwayat', compact('kunjungan', 'member'));
    }
}