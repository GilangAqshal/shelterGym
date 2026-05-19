<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table      = 'notifikasi';
    public    $timestamps = false;

    protected $fillable = [
        'judul', 'pesan', 'idUser', 'tipe', 'isRead'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'isRead'     => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}