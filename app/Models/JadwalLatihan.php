<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalLatihan extends Model
{
    protected $table = 'jadwalLatihan';
    protected $primaryKey = 'idJadwal';

    protected $fillable = ['hari', 'fokusLatihan'];

    public function gerakan()
    {
        return $this->hasMany(GerakanLatihan::class, 'idJadwal');
    }
}