<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function markRead(Notifikasi $notifikasi)
    {
        $notifikasi->update(['isRead' => 1]);
        return response()->json(['success' => true]);
    }

    public function markAllRead()
    {
        Notifikasi::where('isRead', 0)->update(['isRead' => 1]);
        return redirect()->back()->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}
