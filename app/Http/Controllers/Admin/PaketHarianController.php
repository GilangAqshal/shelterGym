<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketHarian;
use Illuminate\Http\Request;

class PaketHarianController extends Controller
{
    public function index()
    {
        $paket = PaketHarian::latest()->get();
        return view('admin.paket-harian.index', compact('paket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:100',
            'harga'        => 'required|numeric|min:0',
        ], [
            'namaKategori.required' => 'Nama kategori wajib diisi.',
            'harga.required'        => 'Harga wajib diisi.',
        ]);

        PaketHarian::create($request->all());

        return redirect()->route('admin.paket-harian.index')
            ->with('success', 'Paket harian berhasil ditambahkan.');
    }

    public function update(Request $request, PaketHarian $paketHarian)
    {
        $request->validate([
            'namaKategori' => 'required|string|max:100',
            'harga'        => 'required|numeric|min:0',
        ]);

        $paketHarian->update($request->all());

        return redirect()->route('admin.paket-harian.index')
            ->with('success', 'Paket harian berhasil diperbarui.');
    }

    public function destroy(PaketHarian $paketHarian)
    {
        $paketHarian->delete();

        return redirect()->route('admin.paket-harian.index')
            ->with('success', 'Paket harian berhasil dihapus.');
    }
}