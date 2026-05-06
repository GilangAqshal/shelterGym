<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;

class MemberController extends Controller
{
    public function index()
    {
        $member = Member::with(['user', 'paket'])->latest()->get();
        return view('admin.member.index', compact('member'));
    }
}