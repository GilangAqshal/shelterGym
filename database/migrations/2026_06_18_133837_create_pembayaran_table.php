<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('orderId')->unique();
            $table->unsignedBigInteger('idUser');
            $table->unsignedBigInteger('idPaket');
            $table->decimal('jumlah', 10, 2);
            $table->string('metodePembayaran')->nullable();
            $table->string('status')->default('pending');
            $table->string('snapToken')->nullable();
            $table->json('midtransResponse')->nullable();
            $table->timestamps();

            $table->foreign('idUser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idPaket')->references('idPaket')->on('paketMember')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};