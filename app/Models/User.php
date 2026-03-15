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
        'name',
        'email',
        'password',
        'role',
        'phone_number', // Tambahkan phone_number juga ya karena tadi ada di migration
    ];

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

    // --- BAGIAN RELASI (COPY DARI SINI) ---

    // Relasi ke Profil Tutor (1 User punya 1 Profil)
    public function tutorProfile()
    {
        return $this->hasOne(TutorProfile::class);
    }

    // Relasi ke Dompet Tutor (1 User punya 1 Dompet)
    public function tutorWallet()
    {
        return $this->hasOne(TutorWallet::class);
    }

    // Jika user ini adalah murid, dia punya banyak pesanan
    public function ordersAsMurid()
    {
        return $this->hasMany(Order::class, 'murid_id');
    }

    // Jika user ini adalah tutor, dia juga punya banyak pesanan
    public function ordersAsTutor()
    {
        return $this->hasMany(Order::class, 'tutor_id');
    }
}