<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('jadwal_request')->nullable()->after('status_pembayaran');
            $table->text('catatan')->nullable()->after('jadwal_request');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['jadwal_request', 'catatan']);
        });
    }
};
