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
        Schema::create('kunjunganMember', function (Blueprint $table) {
            $table->id('idKunjunganMember');
            $table->string('invoice', 30)->unique();
            $table->unsignedBigInteger('idMember');
            $table->date('tanggal');
            $table->timestamp('createdAt')->useCurrent();

            $table->foreign('idMember')->references('idMember')->on('member')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kunjunganMember');
    }
};
