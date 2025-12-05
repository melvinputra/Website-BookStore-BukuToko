<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku = Buku::count();
        $totalPesanan = Pesanan::count();
        $totalUser = User::where('role', 'user')->count();
        $pesananBaru = Pesanan::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalBuku', 'totalPesanan', 'totalUser', 'pesananBaru'));
    }

    public function users()
    {
        $users = User::where('role', 'user')->oldest()->get();
        return view('admin.users', compact('users'));
    }
}
