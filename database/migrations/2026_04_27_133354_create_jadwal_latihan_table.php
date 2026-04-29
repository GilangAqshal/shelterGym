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
    Schema::create('jadwalLatihan', function (Blueprint $table) {
        $table->id('idJadwal');
        $table->enum('hari', ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']);
        $table->string('fokusLatihan', 100);
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('jadwalLatihan');
}
};
