<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketHarian extends Model
{
    protected $table = 'paketHarian';
    protected $primaryKey = 'idPaketHarian';

    protected $fillable = ['namaKategori', 'harga'];

    public function kunjungan()
    {
        return $this->hasMany(KunjunganHarian::class, 'idPaketHarian');
    }
}