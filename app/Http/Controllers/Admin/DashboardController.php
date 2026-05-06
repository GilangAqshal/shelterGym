<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\KunjunganHarian;
use App\Models\KunjunganMember;
use App\Models\PaketMember;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Statistik Utama ──────────────────────────────
        $totalMemberAktif      = Member::where('statusMember', 'aktif')->count();
        $totalMemberTidakAktif = Member::where('statusMember', 'tidak aktif')->count();
        $totalMember           = $totalMemberAktif + $totalMemberTidakAktif;

        $kunjunganHarianHariIni = KunjunganHarian::whereDate('tanggal', today())->count();
        $kunjunganMemberHariIni = KunjunganMember::whereDate('tanggal', today())->count();
        $totalKunjunganHariIni  = $kunjunganHarianHariIni + $kunjunganMemberHariIni;

        $pendapatanHariIni = KunjunganHarian::whereDate('tanggal', today())->sum('harga');

        // ── Grafik Kunjungan 7 Hari Terakhir ────────────
        $labels  = [];
        $dataHarian = [];
        $dataMember = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $labels[]     = $date->translatedFormat('D, d M');
            $dataHarian[] = KunjunganHarian::whereDate('tanggal', $date)->count();
            $dataMember[] = KunjunganMember::whereDate('tanggal', $date)->count();
        }

        // ── Member Terbaru ───────────────────────────────
        $memberTerbaru = Member::with(['user', 'paket'])
                            ->latest()
                            ->take(5)
                            ->get();

        // ── Member Expired (7 hari ke depan) ────────────
        $memberAkanExpired = Member::with('user')
                                ->where('statusMember', 'aktif')
                                ->whereBetween('tanggalAkhir', [
                                    today(),
                                    today()->addDays(7)
                                ])
                                ->orderBy('tanggalAkhir')
                                ->get();

        return view('admin.dashboard', compact(
            'totalMember',
            'totalMemberAktif',
            'totalMemberTidakAktif',
            'totalKunjunganHariIni',
            'kunjunganHarianHariIni',
            'kunjunganMemberHariIni',
            'pendapatanHariIni',
            'labels',
            'dataHarian',
            'dataMember',
            'memberTerbaru',
            'memberAkanExpired'
        ));
    }
}