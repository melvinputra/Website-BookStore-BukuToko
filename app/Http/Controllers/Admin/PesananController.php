<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with(['user', 'pembayaran'])->oldest()->get();
        return view('admin.pesanan.index', compact('pesanans'));
    }

    public function show(Pesanan $pesanan)
    {
        $pesanan->load(['user', 'detailPesanans.buku', 'pembayaran']);
        return view('admin.pesanan.show', compact('pesanan'));
    }

    public function konfirmasi(Pesanan $pesanan)
    {
        if ($pesanan->status === 'tunggu_konfirmasi' && $pesanan->pembayaran) {
            $pesanan->update(['status' => 'dibayar']);
            return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi!');
        }

        return redirect()->back()->with('error', 'Pesanan tidak dapat dikonfirmasi!');
    }

    public function proses(Pesanan $pesanan)
    {
        if ($pesanan->status === 'dibayar') {
            $pesanan->update(['status' => 'diproses']);
            return redirect()->back()->with('success', 'Pesanan sedang diproses!');
        }

        return redirect()->back()->with('error', 'Pesanan tidak dapat diproses!');
    }

    public function kirim(Pesanan $pesanan)
    {
        if ($pesanan->status === 'diproses') {
            $pesanan->update(['status' => 'dikirim']);
            return redirect()->back()->with('success', 'Pesanan sudah dikirim!');
        }

        return redirect()->back()->with('error', 'Pesanan tidak dapat dikirim!');
    }

    public function selesai(Pesanan $pesanan)
    {
        if ($pesanan->status === 'dikirim') {
            $pesanan->update(['status' => 'selesai']);
            return redirect()->back()->with('success', 'Pesanan selesai!');
        }

        return redirect()->back()->with('error', 'Pesanan tidak dapat diselesaikan!');
    }

    public function batal(Pesanan $pesanan)
    {
        // Hanya bisa dibatalkan jika belum diproses
        if (in_array($pesanan->status, ['menunggu_pembayaran', 'tunggu_konfirmasi', 'dibayar'])) {
            DB::beginTransaction();
            try {
                // Kembalikan stok buku
                foreach ($pesanan->detailPesanans as $detail) {
                    $buku = Buku::find($detail->buku_id);
                    if ($buku) {
                        $buku->update(['stok' => $buku->stok + $detail->jumlah]);
                    }
                }

                $pesanan->update(['status' => 'batal']);
                DB::commit();

                return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan dan stok dikembalikan!');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
            }
        }

        return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan!');
    }
}
