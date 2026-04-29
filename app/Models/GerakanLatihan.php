<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GerakanLatihan extends Model
{
    protected $table = 'gerakanLatihan';
    protected $primaryKey = 'idGerakan';

    protected $fillable = [
        'idJadwal', 'namaGerakan', 'gambarGerakan',
        'deskripsi', 'set_reps', 'urutan'
    ];

    public function jadwal()
    {
        return $this->belongsTo(JadwalLatihan::class, 'idJadwal');
    }
}