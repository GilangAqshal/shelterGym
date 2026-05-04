<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KunjunganHarian;
use App\Models\PaketHarian;
use Illuminate\Http\Request;

class KunjunganHarianController extends Controller
{
    // Auto-generate invoice
    private function generateInvoice(): string
    {
        $year    = date('Y');
        $prefix  = "DAILY-{$year}";
        $last    = KunjunganHarian::where('invoice', 'like', "{$prefix}%")
                    ->orderBy('idKunjungan', 'desc')
                    ->first();
        $number  = $last ? (int) substr($last->invoice, -4) + 1 : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $kunjungan = KunjunganHarian::with('paketHarian')
                        ->orderBy('idKunjungan', 'desc')
                        ->get();
        $paket = PaketHarian::all();
        return view('admin.kunjungan-harian.index', compact('kunjungan', 'paket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idPaketHarian'  => 'required|exists:paketHarian,idPaketHarian',
            'namaPengunjung' => 'required|string|max:100',
            'noTelp'         => 'nullable|string|max:20',
            'tanggal'        => 'required|date',
        ], [
            'idPaketHarian.required'  => 'Paket wajib dipilih.',
            'namaPengunjung.required' => 'Nama pengunjung wajib diisi.',
            'tanggal.required'        => 'Tanggal wajib diisi.',
        ]);

        $paket = PaketHarian::findOrFail($request->idPaketHarian);

        KunjunganHarian::create([
            'invoice'        => $this->generateInvoice(),
            'idPaketHarian'  => $request->idPaketHarian,
            'namaPengunjung' => $request->namaPengunjung,
            'noTelp'         => $request->noTelp,
            'harga'          => $paket->harga,
            'tanggal'        => $request->tanggal,
        ]);

        return redirect()->route('admin.kunjungan-harian.index')
            ->with('success', 'Data kunjungan harian berhasil ditambahkan.');
    }

    public function destroy(KunjunganHarian $kunjunganHarian)
    {
        $kunjunganHarian->delete();
        return redirect()->route('admin.kunjungan-harian.index')
            ->with('success', 'Data kunjungan harian berhasil dihapus.');
    }
}