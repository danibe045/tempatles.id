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
            
            $table->integer('pertemuan_ke'); // Contoh: 1, 2, 3, 4
            $table->date('tanggal_jadwal');
            $table->time('waktu_mulai');
            $table->time('waktu_selesai')->nullable();
            
            // Status masing-masing pertemuan
            $table->enum('status_sesi', [
                'dijadwalkan', 
                'selesai',       // Berjalan normal
                'absen_tutor',   // Tutor tidak datang
                'absen_murid'    // Aturan No-Show (Murid bolos, kuota tetap hangus)
            ])->default('dijadwalkan');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_sessions');
    }
};