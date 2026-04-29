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
    Schema::create('gerakanLatihan', function (Blueprint $table) {
        $table->id('idGerakan');
        $table->unsignedBigInteger('idJadwal');
        $table->string('namaGerakan', 150);
        $table->binary('gambarGerakan')->nullable();
        $table->text('deskripsi')->nullable();
        $table->string('set_reps', 50)->nullable();
        $table->integer('urutan')->default(0);
        $table->timestamps();

        $table->foreign('idJadwal')->references('idJadwal')->on('jadwalLatihan')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::dropIfExists('gerakanLatihan');
}
};
