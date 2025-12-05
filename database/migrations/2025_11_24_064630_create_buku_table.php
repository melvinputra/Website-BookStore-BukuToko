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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->string('isbn', 20);
            $table->string('judul', 150);
            $table->string('penulis', 120);
            $table->string('penerbit', 120);
            $table->year('tahun');
            $table->integer('harga');
            $table->integer('stok');
            $table->text('deskripsi');
            $table->string('gambar', 255);
            $table->timestamps();
            
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
