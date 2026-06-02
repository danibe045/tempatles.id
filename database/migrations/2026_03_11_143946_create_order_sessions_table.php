<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            
            $table->integer('pertemuan_ke'); 
            
            // 1. UBAH JADI NULLABLE (Bisa dikosongi dulu)
            $table->date('tanggal_jadwal')->nullable();
            $table->time('waktu_mulai')->nullable();
            
            $table->time('waktu_selesai')->nullable();
            
            // 2. TAMBAHKAN STATUS BARU DAN JADIKAN DEFAULT
            $table->enum('status_sesi', [
                'belum_dijadwalkan', // <--- Tambahan baru
                'dijadwalkan', 
                'selesai',       
                'absen_tutor',   
                'absen_murid'    
            ])->default('belum_dijadwalkan'); // <--- Jadikan default
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_sessions');
    }
};