<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'murid_id', 
        'tutor_id', 
        'tutor_package_id',
        'mata_pelajaran', 
        'jumlah_sesi', 
        'harga_paket', 
        'total_harga_sesi', 
        'biaya_layanan', 
        'grand_total', 
        'status_pesanan', 
        'status_pembayaran',
        'bukti_bayar',
        'jadwal_request',
        'catatan'
    ];

    // Relasi ke Murid (User)
    public function murid()
    {
        return $this->belongsTo(User::class, 'murid_id');
    }

    // Relasi ke Tutor (User)
    public function tutor()
    {
        return $this->belongsTo(User::class, 'tutor_id');
    }

    // Relasi ke Paket yang dibeli
    public function package()
    {
        return $this->belongsTo(TutorPackage::class, 'tutor_package_id');
    }

    // Satu Order punya banyak Sesi Pertemuan (misal 4 atau 8 sesi)
    public function sessions()
    {
        return $this->hasMany(OrderSession::class);
    }
}