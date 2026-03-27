<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payouts', function (Blueprint $table) {
            $table->id();
            
            // Kode unik pencairan (Misal: PAY-20260327-001)
            $table->string('kode_pencairan')->unique();
            
            // Siapa Tutor yang narik uang?
            $table->foreignId('tutor_id')->constrained('users')->onDelete('cascade');
            
            // Nominal yang ditarik
            $table->integer('nominal');
            
            // Snapshot Data Rekening (Biar aman kalau tutor ganti rekening di profilnya)
            $table->string('nama_bank'); // Contoh: BCA, Mandiri, BCA Digital
            $table->string('nomor_rekening');
            $table->string('nama_pemilik_rekening');
            
            // Status Pencairan
            $table->enum('status', [
                'pending',   // Tutor baru *request*
                'diproses',  // Admin sedang mengecek/mentransfer
                'berhasil',  // Uang sudah masuk rekening tutor
                'ditolak'    // Misal: nomor rekening salah/nama tidak sesuai
            ])->default('pending');
            
            // Bukti transfer dari Admin (Struk/Screenshot Mutasi)
            $table->string('bukti_transfer_path')->nullable();
            
            // Catatan jika ditolak
            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payouts');
    }
};