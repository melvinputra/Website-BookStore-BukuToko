<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;

    protected $table = 'detail_pesanan';
    public $timestamps = false;

    protected $fillable = [
        'pesanan_id',
        'buku_id',
        'jumlah',
        'harga',
    ];

    // Relationships
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
