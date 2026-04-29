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
        Schema::create('paketMember', function (Blueprint $table) {
            $table->id('idPaket');
            $table->string('namaPaket', 100);
            $table->integer('durasiPaket')->comment('dalam hari');
            $table->text('deskripsiPaket')->nullable();
            $table->decimal('hargaPaket', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paketMember');
    }
};
