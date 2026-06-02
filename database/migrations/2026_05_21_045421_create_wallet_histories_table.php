<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallet_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained('tutor_wallets')->onDelete('cascade');
            $table->enum('type', ['in', 'out']); // 'in' = uang masuk, 'out' = uang ditarik (payout)
            $table->integer('amount'); // Nominal mutasi
            $table->string('description'); // Contoh: "Pembayaran Kelas MTK" atau "Pencairan Dana"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallet_histories');
    }
};