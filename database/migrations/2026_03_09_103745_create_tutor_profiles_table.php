<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tutor_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // DATA DEMOGRAFI & LATAR BELAKANG
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->text('alamat_domisili');
            $table->string('pendidikan_terakhir');
            $table->string('instansi'); 
            $table->string('bidang'); 
            $table->text('pengalaman'); 
            $table->boolean('is_manual')->default(false);
            $table->string('link')->nullable()->comment('Link Google Drive PDF Silabus');
            
            // Status Akun & Mutu Kendali
            $table->boolean('setuju_pernyataan')->default(false); 
            $table->integer('strike_count')->default(0); 
            $table->enum('status_akun', [
                'menunggu_mou', 
                'aktif', 
                'dibekukan', 
                'banned'
            ])->default('menunggu_mou');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tutor_profiles');
    }
};