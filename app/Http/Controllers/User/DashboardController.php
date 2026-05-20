<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\JadwalLatihan;
use App\Models\KunjunganMember;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
public function index()
{
    /** @var \App\Models\User $user */
    $user = Auth::user();

    $member = Member::where('idUser', $user->id)->with('paket')->first();

    // Auto update expired
    if ($member && $member->statusMember === 'aktif' && $member->tanggalAkhir) {
        if (\Carbon\Carbon::parse($member->tanggalAkhir)->isPast()) {
            $member->update(['statusMember' => 'tidak aktif']);
            $member->refresh();
        }
    }

    // Sisa hari
    $sisaHari = null;
    if ($member && $member->statusMember === 'aktif' && $member->tanggalAkhir) {
        $sisaHari = \Carbon\Carbon::today()->diffInDays(
            \Carbon\Carbon::parse($member->tanggalAkhir), false
        );
    }

    // Cek sudah check-in hari ini
    $sudahCheckinHariIni = false;
    if ($member && $member->statusMember === 'aktif') {
        $sudahCheckinHariIni = KunjunganMember::where('idMember', $member->idMember)
                                    ->whereDate('tanggal', today())
                                    ->exists();
    }

    // Jadwal hari ini
    $hariIni = ucfirst(\Carbon\Carbon::now()->locale('id')->dayName);
    $jadwalHariIni = \App\Models\JadwalLatihan::where('hari', $hariIni)
                        ->with('gerakan')
                        ->first();

    // Riwayat kunjungan (5 terakhir)
    $riwayatKunjungan = collect();
    if ($member) {
        $riwayatKunjungan = KunjunganMember::where('idMember', $member->idMember)
                                ->orderBy('tanggal', 'desc')
                                ->take(5)
                                ->get();
    }

    // Kunjungan bulan ini
    $kunjunganBulanIni = 0;
    if ($member) {
        $kunjunganBulanIni = KunjunganMember::where('idMember', $member->idMember)
                                ->whereMonth('tanggal', now()->month)
                                ->whereYear('tanggal', now()->year)
                                ->count();
    }

    // Paket list untuk modal beli
    $paketList = \App\Models\PaketMember::all();

    return view('user.dashboard', compact(
        'user', 'member', 'sisaHari', 'hariIni',
        'jadwalHariIni', 'riwayatKunjungan', 'kunjunganBulanIni',
        'paketList', 'sudahCheckinHariIni'
    ));
}

    public function jadwal()
    {
        $jadwal = JadwalLatihan::with('gerakan')
                    ->orderByRaw("FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
                    ->get();

        $hariIni = ucfirst(Carbon::now()->locale('id')->dayName);

        return view('user.jadwal', compact('jadwal', 'hariIni'));
    }
}