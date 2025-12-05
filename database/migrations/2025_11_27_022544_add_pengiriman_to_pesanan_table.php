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
        Schema::table('pesanan', function (Blueprint $table) {
            $table->string('nama_penerima')->nullable()->after('status');
            $table->text('alamat_pengiriman')->nullable()->after('nama_penerima');
            $table->string('no_hp')->nullable()->after('alamat_pengiriman');
            $table->text('catatan')->nullable()->after('no_hp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $table->dropColumn(['nama_penerima', 'alamat_pengiriman', 'no_hp', 'catatan']);
        });
    }
};
