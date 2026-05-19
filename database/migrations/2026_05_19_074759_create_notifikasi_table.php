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
    Schema::create('notifikasi', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('pesan');
        $table->unsignedBigInteger('idUser');
        $table->string('tipe')->default('pembelian_member');
        $table->tinyInteger('isRead')->default(0);
        $table->timestamp('created_at')->useCurrent();

        $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('notifikasi');
}
};
