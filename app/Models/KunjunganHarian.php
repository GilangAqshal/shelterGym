<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KunjunganHarian extends Model
{
    protected $table = 'kunjunganHarian';
    protected $primaryKey = 'idKunjungan';
    public $timestamps = false;

    protected $fillable = [
        'invoice', 'idPaketHarian', 'namaPengunjung',
        'noTelp', 'harga', 'tanggal'
    ];

    public function paketHarian()
    {
        return $this->belongsTo(PaketHarian::class, 'idPaketHarian');
    }
}