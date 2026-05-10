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

        // Data member
        $member = Member::where('idUser', $user->id)
                    ->with('paket')
                    ->first();

        // Cek & update status expired otomatis
        if ($member && $member->statusMember === 'aktif') {
            if (Carbon::parse($member->tanggalAkhir)->isPast()) {
                $member->update(['statusMember' => 'tidak aktif']);
                $member->refresh();
            }
        }

        // Sisa hari membership
        $sisaHari = null;
        if ($member && $member->statusMember === 'aktif') {
            $sisaHari = Carbon::today()->diffInDays(
                Carbon::parse($member->tanggalAkhir), false
            );
        }

        // Jadwal hari ini
        $hariIni = Carbon::now()->locale('id')->dayName;
        $hariIni = ucfirst($hariIni);
        $jadwalHariIni = JadwalLatihan::where('hari', $hariIni)
                            ->with('gerakan')
                            ->first();

        // Riwayat kunjungan
        $riwayatKunjungan = collect();
        if ($member) {
            $riwayatKunjungan = KunjunganMember::where('idMember', $member->idMember)
                                    ->orderBy('tanggal', 'desc')
                                    ->take(5)
                                    ->get();
        }

        // Total kunjungan bulan ini
        $kunjunganBulanIni = 0;
        if ($member) {
            $kunjunganBulanIni = KunjunganMember::where('idMember', $member->idMember)
                                    ->whereMonth('tanggal', now()->month)
                                    ->whereYear('tanggal', now()->year)
                                    ->count();
        }

        return view('user.dashboard', compact(
            'user', 'member', 'sisaHari', 'hariIni',
            'jadwalHariIni', 'riwayatKunjungan', 'kunjunganBulanIni'
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