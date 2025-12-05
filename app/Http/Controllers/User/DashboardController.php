<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->latest()->take(8)->get();
        return view('user.dashboard', compact('bukus'));
    }
}
