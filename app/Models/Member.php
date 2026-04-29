<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'member';
    protected $primaryKey = 'idMember';

    protected $fillable = [
        'noPendaftaran', 'kodeMember', 'idUser', 'idPaket',
        'noTelp', 'statusMember', 'tanggalDaftar', 'tanggalAkhir'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function paket()
    {
        return $this->belongsTo(PaketMember::class, 'idPaket');
    }

    public function kunjungan()
    {
        return $this->hasMany(KunjunganMember::class, 'idMember');
    }
}