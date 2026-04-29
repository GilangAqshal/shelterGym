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
        Schema::create('kunjunganHarian', function (Blueprint $table) {
            $table->id('idKunjungan');
            $table->string('invoice', 30)->unique();
            $table->unsignedBigInteger('idPaketHarian');
            $table->string('namaPengunjung', 100);
            $table->string('noTelp', 20)->nullable();
            $table->decimal('harga', 10, 2);
            $table->date('tanggal');
            $table->timestamp('createdAt')->useCurrent();

            $table->foreign('idPaketHarian')->references('idPaketHarian')->on('paketHarian')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjunganHarian');
    }
};
