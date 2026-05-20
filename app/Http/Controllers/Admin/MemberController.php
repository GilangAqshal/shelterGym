<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\PaketMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MemberController extends Controller
{
    // Auto-generate noPendaftaran
    private function generateNoPendaftaran(): string
    {
        $year   = date('Y');
        $prefix = "REG-{$year}";
        $last   = Member::where('noPendaftaran', 'like', "{$prefix}%")
                    ->orderBy('idMember', 'desc')->first();
        $number = $last ? (int) substr($last->noPendaftaran, -4) + 1 : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    // Auto-generate kodeMember
    private function generateKodeMember(): string
    {
        $last   = Member::orderBy('idMember', 'desc')->first();
        $number = $last ? (int) substr($last->kodeMember, -4) + 1 : 1;
        return 'MBR-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $member = Member::with(['user', 'paket'])
                    ->orderBy('idMember', 'desc')
                    ->get();
        $paket  = PaketMember::all();
        return view('admin.member.index', compact('member', 'paket'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email',
            'password'     => 'required|min:6',
            'noTelp'       => 'nullable|string|max:20',
            'jenisKelamin' => 'nullable|in:Laki-laki,Perempuan',
            'tanggalLahir' => 'nullable|date',
            'alamat'       => 'nullable|string',
            'idPaket'      => 'required|exists:paketMember,idPaket',
            'tanggalDaftar'=> 'required|date',
        ], [
            'name.required'         => 'Nama wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.unique'          => 'Email sudah digunakan.',
            'password.required'     => 'Password wajib diisi.',
            'password.min'          => 'Password minimal 6 karakter.',
            'idPaket.required'      => 'Paket wajib dipilih.',
            'tanggalDaftar.required'=> 'Tanggal daftar wajib diisi.',
        ]);

        // Buat user baru dengan role user
        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'noTelp'       => $request->noTelp,
            'jenisKelamin' => $request->jenisKelamin,
            'tanggalLahir' => $request->tanggalLahir,
            'alamat'       => $request->alamat,
            'role'         => 'user',
        ]);

        // Hitung tanggal akhir
        $paket        = PaketMember::findOrFail($request->idPaket);
        $tanggalAkhir = Carbon::parse($request->tanggalDaftar)
                            ->addDays($paket->durasiPaket)
                            ->format('Y-m-d');

        Member::create([
            'noPendaftaran' => $this->generateNoPendaftaran(),
            'kodeMember'    => $this->generateKodeMember(),
            'idUser'        => $user->id,
            'idPaket'       => $request->idPaket,
            'noTelp'        => $request->noTelp,
            'statusMember'  => 'aktif',
            'tanggalDaftar' => $request->tanggalDaftar,
            'tanggalAkhir'  => $tanggalAkhir,
        ]);

        return redirect()->route('admin.member.index')
            ->with('success', 'Data member berhasil ditambahkan.');
    }

public function update(Request $request, Member $member)
{
    $request->validate([
        'idPaket'      => 'required|exists:paketMember,idPaket',
        'statusMember' => 'required|in:aktif,tidak aktif',
        'noTelp'       => 'nullable|string|max:20',
    ]);

    $data = [
        'idPaket'      => $request->idPaket,
        'noTelp'       => $request->noTelp,
        'statusMember' => $request->statusMember,
    ];

    // Jika diaktifkan → isi tanggal otomatis
    if ($request->statusMember === 'aktif' && $member->statusMember !== 'aktif') {
        $paket = \App\Models\PaketMember::findOrFail($request->idPaket);
        $data['tanggalDaftar'] = today()->format('Y-m-d');
        $data['tanggalAkhir']  = today()->addDays($paket->durasiPaket)->format('Y-m-d');

        // Tandai notifikasi terkait sebagai sudah dibaca
        \App\Models\Notifikasi::where('idUser', $member->idUser)
            ->where('tipe', 'pembelian_member')
            ->where('isRead', 0)
            ->update(['isRead' => 1]);
    }

    // Update nama & noTelp di tabel users juga
    if ($request->filled('name')) {
        $member->user->update(['name' => $request->name]);
    }
    $member->user->update(['noTelp' => $request->noTelp]);

    $member->update($data);

    return redirect()->route('admin.member.index')
        ->with('success', 'Data member berhasil diperbarui.');
}

    public function destroy(Member $member)
    {
        $user = $member->user;
        $member->delete();
        $user->delete();

        return redirect()->route('admin.member.index')
            ->with('success', 'Data member berhasil dihapus.');
    }
}