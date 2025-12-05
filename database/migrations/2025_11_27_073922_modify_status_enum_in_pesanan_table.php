<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify enum to add 'selesai' status
        DB::statement("ALTER TABLE pesanan MODIFY COLUMN status ENUM('pending', 'menunggu_pembayaran', 'tunggu_konfirmasi', 'dibayar', 'diproses', 'dikirim', 'selesai', 'batal')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE pesanan MODIFY COLUMN status ENUM('pending', 'menunggu_pembayaran', 'tunggu_konfirmasi', 'dibayar', 'diproses', 'dikirim', 'batal')");
    }
};
