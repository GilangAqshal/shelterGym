<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('member', function (Blueprint $table) {
        $table->date('tanggalDaftar')->nullable()->change();
        $table->date('tanggalAkhir')->nullable()->change();
    });
}

public function down(): void
{
    Schema::table('member', function (Blueprint $table) {
        $table->date('tanggalDaftar')->nullable(false)->change();
        $table->date('tanggalAkhir')->nullable(false)->change();
    });
}
};
