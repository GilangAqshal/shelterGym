<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaketMember;
use Illuminate\Http\Request;

class PaketMemberController extends Controller
{
    public function index()
    {
        $paket = PaketMember::latest()->get();
        return view('admin.paket-member.index', compact('paket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaPaket'     => 'required|string|max:100',
            'durasiPaket'   => 'required|integer|min:1',
            'hargaPaket'    => 'required|numeric|min:0',
            'deskripsiPaket'=> 'nullable|string',
        ], [
            'namaPaket.required'   => 'Nama paket wajib diisi.',
            'durasiPaket.required' => 'Durasi paket wajib diisi.',
            'hargaPaket.required'  => 'Harga paket wajib diisi.',
        ]);

        PaketMember::create($request->all());

        return redirect()->route('admin.paket-member.index')
            ->with('success', 'Paket member berhasil ditambahkan.');
    }

    public function update(Request $request, PaketMember $paketMember)
    {
        $request->validate([
            'namaPaket'     => 'required|string|max:100',
            'durasiPaket'   => 'required|integer|min:1',
            'hargaPaket'    => 'required|numeric|min:0',
            'deskripsiPaket'=> 'nullable|string',
        ]);

        $paketMember->update($request->all());

        return redirect()->route('admin.paket-member.index')
            ->with('success', 'Paket member berhasil diperbarui.');
    }

    public function destroy(PaketMember $paketMember)
    {
        $paketMember->delete();

        return redirect()->route('admin.paket-member.index')
            ->with('success', 'Paket member berhasil dihapus.');
    }
}