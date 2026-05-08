<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KunjunganHarian;
use App\Models\KunjunganMember;
use App\Models\Member;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanExport;

class LaporanController extends Controller
{
    private function getData(Request $request): array
    {
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $kunjunganHarian = KunjunganHarian::with('paketHarian')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'desc')
            ->get();

        $kunjunganMember = KunjunganMember::with('member.user')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalPendapatan  = $kunjunganHarian->sum('harga');
        $totalKunjungan   = $kunjunganHarian->count() + $kunjunganMember->count();
        $memberBaru       = Member::whereMonth('tanggalDaftar', $bulan)
                                ->whereYear('tanggalDaftar', $tahun)
                                ->count();

        // Data grafik per hari dalam bulan
        $daysInMonth = Carbon::create($tahun, $bulan)->daysInMonth;
        $grafikHarian  = [];
        $grafikMember  = [];
        $grafikLabels  = [];

        for ($d = 1; $d <= $daysInMonth; $d++) {
            $date = Carbon::create($tahun, $bulan, $d);
            if ($date->isAfter(Carbon::today())) break;

            $grafikLabels[]  = $d;
            $grafikHarian[]  = KunjunganHarian::whereDate('tanggal', $date)->count();
            $grafikMember[]  = KunjunganMember::whereDate('tanggal', $date)->count();
        }

        $namaBulan = Carbon::create($tahun, $bulan)->translatedFormat('F Y');

        return compact(
            'bulan', 'tahun', 'namaBulan',
            'kunjunganHarian', 'kunjunganMember',
            'totalPendapatan', 'totalKunjungan', 'memberBaru',
            'grafikLabels', 'grafikHarian', 'grafikMember'
        );
    }

    public function index(Request $request)
    {
        $data = $this->getData($request);
        return view('admin.laporan.index', $data);
    }

    public function exportPdf(Request $request)
    {
        $data = $this->getData($request);
        $pdf  = Pdf::loadView('admin.laporan.pdf', $data)
                    ->setPaper('a4', 'landscape');
        return $pdf->download("Laporan-{$data['namaBulan']}.pdf");
    }

    public function exportExcel(Request $request)
    {
        $bulan    = $request->bulan ?? date('m');
        $tahun    = $request->tahun ?? date('Y');
        $namaBulan = Carbon::create($tahun, $bulan)->translatedFormat('F Y');

        return Excel::download(
            new LaporanExport($bulan, $tahun),
            "Laporan-{$namaBulan}.xlsx"
        );
    }
}