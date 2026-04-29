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
        Schema::create('member', function (Blueprint $table) {
            $table->id('idMember');
            $table->string('noPendaftaran', 20)->unique();
            $table->string('kodeMember', 20)->unique();
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idPaket');
            $table->string('noTelp', 20)->nullable();
            $table->enum('statusMember', ['aktif', 'tidak aktif'])->default('tidak aktif');
            $table->date('tanggalDaftar');
            $table->date('tanggalAkhir');
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idPaket')->references('idPaket')->on('paketMember')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('member');
    }
};
