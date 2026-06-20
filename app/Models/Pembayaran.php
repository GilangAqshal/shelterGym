<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'orderId', 'idUser', 'idPaket', 'jumlah',
        'metodePembayaran', 'status', 'snapToken', 'midtransResponse'
    ];

    protected $casts = [
        'midtransResponse' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function paket()
    {
        return $this->belongsTo(PaketMember::class, 'idPaket');
    }
}