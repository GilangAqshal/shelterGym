<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

    // Accessor URL gambar
    public function getGambarUrlAttribute(): string
    {
        // Gunakan facade Storage yang sudah di-import di atas
        if ($this->gambarGerakan && Storage::disk('public')->exists($this->gambarGerakan)) {
            return asset('storage/' . $this->gambarGerakan);
        }
        return asset('images/default-gerakan.webp');
    }

}