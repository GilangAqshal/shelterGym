<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketMember extends Model
{
    protected $table = 'paketMember';
    protected $primaryKey = 'idPaket';

    protected $fillable = [
        'namaPaket', 'durasiPaket', 'deskripsiPaket', 'hargaPaket'
    ];

    public function member()
    {
        return $this->hasMany(Member::class, 'idPaket');
    }
}