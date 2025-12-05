<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil buku populer (6 buku terbaru atau dengan stok terbanyak)
        $bukuPopuler = Buku::with('kategori')
            ->where('stok', '>', 0)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        
        // Ambil semua kategori
        $kategoris = Kategori::withCount('bukus')->get();
        
        // Hitung statistik
        $totalBuku = Buku::count();
        $totalKategori = Kategori::count();
        
        return view('welcome', compact('bukuPopuler', 'kategoris', 'totalBuku', 'totalKategori'));
    }
}
