<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tutor_profiles', function (Blueprint $table) {
            $table->id();
            // Kunci Relasi ke tabel users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Latar Belakang & Demografi
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('pendidikan_terakhir');
            $table->string('instansi'); 
            $table->string('bidang'); 
            $table->text('pengalaman'); 
            
            // Katalog & Harga
            $table->json('tingkat_siswa'); // Array: SD, SMP, SMA, Umum
            $table->json('metode'); // Array: Online, Offline
            $table->json('hari'); // Array ketersediaan hari
            $table->string('jam'); // Ketersediaan jam
            $table->string('area'); // Jangkauan lokasi
            $table->integer('tarif_per_sesi')->default(0); 
            
            // Status Akun & Kendali Mutu
            $table->boolean('setuju_pernyataan')->default(false); 
            $table->integer('strike_count')->default(0); // Indikator 3-Strike
            $table->enum('status_akun', ['pending', 'menunggu_mou', 'aktif', 'dibekukan', 'banned'])->default('pending');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutor_profiles');
    }
};