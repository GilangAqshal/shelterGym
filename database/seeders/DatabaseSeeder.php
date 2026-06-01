<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Owner
        User::create([
            'name'         => 'OwnerSG',
            'email'        => 'ownerSG@gmail.com',
            'password'     => Hash::make('owner123'),
            'role'         => 'owner',
            'noTelp'       => '08123456789',
            'jenisKelamin' => 'Laki-laki',
            'tanggalLahir' => '1990-01-01',
            'alamat'       => 'Jakarta',
        ]);

        // Admin
        User::create([
            'name'         => 'AdminSG',
            'email'        => 'adminSG@gmail.com',
            'password'     => Hash::make('admin123'),
            'role'         => 'admin',
            'noTelp'       => '08987654321',
            'jenisKelamin' => 'Laki-laki',
            'tanggalLahir' => '1995-05-05',
            'alamat'       => 'Jakarta',
        ]);

        // --- TAMBAHAN ROLE USER DISINI ---
        User::create([
            'name'         => 'Langs',
            'email'        => 'langs16@gmail.com',
            'password'     => Hash::make('langs16'), 
            'role'         => 'user',
            'noTelp'       => '081292700357',
            'jenisKelamin' => 'Laki-laki', 
            'tanggalLahir' => '2000-04-18', 
            'alamat'       => 'Bekasi', 
        ]);

        // Paket Member
        DB::table('paketMember')->insert([
            ['namaPaket'=>'Paket 1 Bulan',  'durasiPaket'=>30,  'hargaPaket'=>125000, 'deskripsiPaket'=>'Akses gym 1 bulan', 'created_at'=>now(), 'updated_at'=>now()],
            ['namaPaket'=>'Paket 3 Bulan',  'durasiPaket'=>90,  'hargaPaket'=>350000, 'deskripsiPaket'=>'Akses gym 3 bulan',       'created_at'=>now(), 'updated_at'=>now()],
            ['namaPaket'=>'Paket 6 Bulan',  'durasiPaket'=>180, 'hargaPaket'=>700000, 'deskripsiPaket'=>'Akses gym 6 bulan',       'created_at'=>now(), 'updated_at'=>now()],
        ]);

        // Paket Harian
        DB::table('paketHarian')->insert([
            ['namaKategori'=>'Sehari', 'harga'=>20000, 'created_at'=>now(), 'updated_at'=>now()],
            ['namaKategori'=>'Tiga Hari', 'harga'=>50000, 'created_at'=>now(), 'updated_at'=>now()],
        ]);

        // Jadwal Latihan
        DB::table('jadwalLatihan')->insert([
            ['hari'=>'Senin',  'fokusLatihan'=>'Chest & Triceps',  'created_at'=>now(), 'updated_at'=>now()],
            ['hari'=>'Selasa', 'fokusLatihan'=>'Back & Biceps',    'created_at'=>now(), 'updated_at'=>now()],
            ['hari'=>'Rabu',   'fokusLatihan'=>'Shoulder & Core',  'created_at'=>now(), 'updated_at'=>now()],
            ['hari'=>'Kamis',  'fokusLatihan'=>'Leg Day',          'created_at'=>now(), 'updated_at'=>now()],
            ['hari'=>'Jumat',  'fokusLatihan'=>'Full Body',        'created_at'=>now(), 'updated_at'=>now()],
            ['hari'=>'Sabtu',  'fokusLatihan'=>'Kardio',           'created_at'=>now(), 'updated_at'=>now()],
            ['hari'=>'Minggu', 'fokusLatihan'=>'Rest / Stretching','created_at'=>now(), 'updated_at'=>now()],
        ]);
    }
}