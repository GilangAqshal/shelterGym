<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KunjunganMember extends Model
{
    protected $table = 'kunjunganMember';
    protected $primaryKey = 'idKunjunganMember';
    public $timestamps = false;

    protected $fillable = ['invoice', 'idMember', 'tanggal'];

    public function member()
    {
        return $this->belongsTo(Member::class, 'idMember');
    }
}