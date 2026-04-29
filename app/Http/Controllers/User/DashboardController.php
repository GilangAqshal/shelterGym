<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\JadwalLatihan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user   = Auth::user();
        $member = Member::where('idUser', $user->id)->with('paket')->first();
        $jadwal = JadwalLatihan::with('gerakan')->get();

        return view('user.dashboard', compact('member', 'jadwal'));
    }
}