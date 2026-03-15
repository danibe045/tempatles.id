<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Menggunakan enum agar hanya bisa diisi 3 peran ini
            $table->enum('role', ['admin', 'tutor', 'murid'])->default('murid')->after('email');
            
            // Nomor WA wajib di sini agar berlaku untuk semua (Tutor maupun Murid)
            $table->string('phone_number')->nullable()->after('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone_number']);
        });
    }
};