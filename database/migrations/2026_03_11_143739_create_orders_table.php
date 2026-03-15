<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // 1. Relasi ke tabel users (Siapa muridnya, siapa tutornya)
            $table->foreignId('murid_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tutor_id')->constrained('users')->onDelete('cascade');
            
            // 2. Detail Pesanan
            $table->string('mata_pelajaran');
            $table->integer('jumlah_sesi'); // Contoh: 4 atau 8 sesi
            
            // 3. Rincian Biaya (Disimpan sebagai snapshot agar harga tidak berubah jika tutor menaikkan tarif di masa depan)
            $table->integer('tarif_per_sesi'); 
            $table->integer('total_harga_sesi'); // tarif_per_sesi x jumlah_sesi
            $table->integer('biaya_layanan'); // 10% dari total_harga untuk platform
            $table->integer('grand_total'); // total_harga_sesi + biaya_layanan yang harus dibayar murid
            
            // 4. Siklus Status Booking
            $table->enum('status_pesanan', [
                'menunggu_konfirmasi', // Tutor belum klik terima/tolak
                'menunggu_pembayaran', // Tutor setuju, tunggu murid bayar
                'berjalan',            // Murid sudah lunas, kelas dimulai
                'selesai',             // Kelas beres 100%
                'komplain',            // Ada masalah, dana ditahan untuk mediasi
                'dibatalkan'           // Ditolak tutor atau expired
            ])->default('menunggu_konfirmasi');
            
            // 5. Status Keuangan (Sistem Escrow)
            $table->enum('status_pembayaran', [
                'belum_bayar', 
                'lunas_escrow', // Uang aman dipegang Admin/Sistem
                'dicairkan'     // Uang sudah ditransfer ke tutor (Payout)
            ])->default('belum_bayar');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};