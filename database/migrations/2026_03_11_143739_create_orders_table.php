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
            
            // 1. Relasi (Tambahkan tutor_package_id)
            $table->foreignId('murid_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tutor_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('tutor_package_id')->nullable()->constrained('tutor_packages')->onDelete('set null');
            
            // 2. Detail Pesanan
            $table->string('mata_pelajaran');
            $table->integer('jumlah_sesi');
            
            // 3. Rincian Biaya 
            $table->integer('harga_paket');
            $table->integer('total_harga_sesi'); 
            $table->integer('biaya_layanan'); 
            $table->integer('grand_total'); 
            
            // 4. Status Booking
            $table->enum('status_pesanan', [
                'menunggu_konfirmasi', 
                'menunggu_pembayaran', 
                'berjalan',            
                'selesai',             
                'komplain',            
                'dibatalkan'           
            ])->default('menunggu_konfirmasi');
            
            // 5. Status Keuangan
            $table->enum('status_pembayaran', [
                'belum_bayar', 
                'lunas_escrow', 
                'dicairkan'     
            ])->default('belum_bayar');

            $table->string('bukti_bayar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};