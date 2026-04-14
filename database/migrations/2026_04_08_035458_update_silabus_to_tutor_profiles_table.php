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
        // 1. Tambahkan kolom link_silabus di tabel tutor_profiles
        Schema::table('tutor_profiles', function (Blueprint $table) {
            $table->string('link_silabus')->nullable()->after('tarif_per_sesi')
                ->comment('Link Google Drive PDF Silabus');
        });

        // 2. Hapus tabel silabus yang lama karena sudah tidak dipakai
        Schema::dropIfExists('silabus');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hapus kolom jika di-rollback
        Schema::table('tutor_profiles', function (Blueprint $table) {
            $table->dropColumn('link_silabus');
        });

        // (Opsional) Kamu bisa membuat ulang skema tabel silabus di sini 
    }
};