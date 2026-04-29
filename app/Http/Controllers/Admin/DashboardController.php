<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\KunjunganHarian;
use App\Models\KunjunganMember;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'totalMember'         => Member::where('statusMember', 'aktif')->count(),
            'totalMemberTidakAktif' => Member::where('statusMember', 'tidak aktif')->count(),
            'kunjunganHariIni'    => KunjunganHarian::whereDate('tanggal', today())->count()
                                   + KunjunganMember::whereDate('tanggal', today())->count(),
            'pendapatanHariIni'   => KunjunganHarian::whereDate('tanggal', today())->sum('harga'),
        ];

        return view('admin.dashboard', compact('data'));
    }
}