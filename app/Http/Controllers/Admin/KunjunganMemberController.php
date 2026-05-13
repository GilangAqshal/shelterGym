<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KunjunganMember;
use App\Models\Member;
use Illuminate\Http\Request;

class KunjunganMemberController extends Controller
{
    private function generateInvoice(): string
    {
        $year   = date('Y');
        $prefix = "MEMBER-{$year}";
        $last   = KunjunganMember::where('invoice', 'like', "{$prefix}%")
                    ->orderBy('idKunjunganMember', 'desc')
                    ->first();
        $number = $last ? (int) substr($last->invoice, -4) + 1 : 1;
        return $prefix . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $kunjungan = KunjunganMember::with('member.user')
                        ->orderBy('idKunjunganMember', 'desc')
                        ->get();

        $member = Member::with('user')
                    ->where('statusMember', 'aktif')
                    ->get();

        return view('admin.kunjungan-member.index', compact('kunjungan', 'member'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idMember' => 'required|exists:member,idMember',
            'tanggal'  => 'required|date',
        ], [
            'idMember.required' => 'Member wajib dipilih.',
            'tanggal.required'  => 'Tanggal wajib diisi.',
        ]);

        $member = \App\Models\Member::findOrFail($request->idMember);

        // ── Validasi status aktif ──────────────────────────
        if ($member->statusMember !== 'aktif') {
            return redirect()->route('admin.kunjungan-member.index')
                ->with('error', 'Member ini sudah tidak aktif. Tidak bisa check-in.');
        }

        // ── Validasi tanggal kunjungan dalam masa berlaku ──
        $tanggal = \Carbon\Carbon::parse($request->tanggal);
        if ($tanggal->isAfter(\Carbon\Carbon::parse($member->tanggalAkhir))) {
            return redirect()->route('admin.kunjungan-member.index')
                ->with('error', 'Tanggal kunjungan melebihi masa berlaku member.');
        }

        // ── Validasi sudah check-in hari ini ──────────────
        $sudahCheckin = KunjunganMember::where('idMember', $request->idMember)
                            ->whereDate('tanggal', $request->tanggal)
                            ->exists();

        if ($sudahCheckin) {
            return redirect()->route('admin.kunjungan-member.index')
                ->with('error', 'Member ini sudah melakukan kunjungan pada tanggal tersebut.');
        }

        KunjunganMember::create([
            'invoice'  => $this->generateInvoice(),
            'idMember' => $request->idMember,
            'tanggal'  => $request->tanggal,
        ]);

        return redirect()->route('admin.kunjungan-member.index')
            ->with('success', 'Kunjungan member berhasil dicatat.');
    }

    public function destroy(KunjunganMember $kunjunganMember)
    {
        $kunjunganMember->delete();
        return redirect()->route('admin.kunjungan-member.index')
            ->with('success', 'Data kunjungan member berhasil dihapus.');
    }
}
