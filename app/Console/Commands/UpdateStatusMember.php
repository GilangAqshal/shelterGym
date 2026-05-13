<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Member;
use Carbon\Carbon;

class UpdateStatusMember extends Command
{
    protected $signature   = 'member:update-status';
    protected $description = 'Update status member yang sudah expired menjadi tidak aktif';

    public function handle(): void
    {
        $expired = Member::where('statusMember', 'aktif')
                        ->where('tanggalAkhir', '<', Carbon::today())
                        ->get();

        $count = $expired->count();

        $expired->each(fn($m) => $m->update(['statusMember' => 'tidak aktif']));

        $this->info("✅ {$count} member berhasil diupdate menjadi tidak aktif.");
    }
}