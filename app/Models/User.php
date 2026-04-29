<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name', 'email', 'password',
    'noTelp', 'jenisKelamin', 'tanggalLahir', 'alamat','foto', 'role'
    ];

    public function member()
    {
        return $this->hasOne(Member::class, 'idUser');
    }

    public function getFotoUrlAttribute(): string
    {
        if ($this->foto && file_exists(storage_path('app/public/' . $this->foto))) {
            return asset('storage/' . $this->foto);
        }

        return asset('images/default-avatar.jpg');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
