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
        Schema::table('users', function (Blueprint $table) {
            $table->string('noTelp', 20)->nullable()->after('email');
            $table->enum('jenisKelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('noTelp');
            $table->date('tanggalLahir')->nullable()->after('jenisKelamin');
            $table->text('alamat')->nullable()->after('tanggalLahir');
            $table->enum('role', ['owner', 'admin', 'user'])->default('user')->after('alamat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['noTelp','jenisKelamin','tanggalLahir','alamat','role']);
        });
    }
};
