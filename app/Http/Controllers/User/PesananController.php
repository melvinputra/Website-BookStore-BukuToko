<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\DetailPesanan;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::where('user_id', auth()->id())
            ->with(['detailPesanans.buku', 'pembayaran'])
            ->latest()
            ->get();

        return view('user.pesanan.index', compact('pesanans'));
    }

    /**
     * Tampilkan halaman checkout dari keranjang
     */
    public function showCheckout()
    {
        $keranjangs = Keranjang::where('user_id', auth()->id())->with('buku')->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->route('user.keranjang.index')->with('error', 'Keranjang kosong!');
        }

        $totalHarga = $keranjangs->sum(function($item) {
            return $item->buku->harga * $item->jumlah;
        });

        return view('user.pesanan.checkout', [
            'keranjangs' => $keranjangs,
            'totalHarga' => $totalHarga,
            'type' => 'cart', // checkout dari keranjang
            'buku' => null,
            'jumlah' => null,
        ]);
    }

    /**
     * Tampilkan halaman checkout untuk Beli Sekarang (langsung dari detail buku)
     */
    public function showCheckoutBuyNow(Request $request, Buku $buku)
    {
        $jumlah = $request->input('jumlah', 1);
        
        if ($buku->stok < $jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        $totalHarga = $buku->harga * $jumlah;

        return view('user.pesanan.checkout', [
            'keranjangs' => null,
            'totalHarga' => $totalHarga,
            'type' => 'buy_now', // checkout langsung
            'buku' => $buku,
            'jumlah' => $jumlah,
        ]);
    }

    /**
     * Process checkout dari keranjang
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'nama_penerima' => 'required|string|max:255',
            'alamat_pengiriman' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'catatan' => 'nullable|string',
        ]);

        $keranjangs = Keranjang::where('user_id', auth()->id())->with('buku')->get();

        if ($keranjangs->isEmpty()) {
            return redirect()->route('user.keranjang.index')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        try {
            $totalHarga = $keranjangs->sum(function($item) {
                return $item->buku->harga * $item->jumlah;
            });

            // Create pesanan dengan data pengiriman
            $pesanan = Pesanan::create([
                'user_id' => auth()->id(),
                'total_harga' => $totalHarga,
                'status' => 'menunggu_pembayaran',
                'nama_penerima' => $request->nama_penerima,
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'no_hp' => $request->no_hp,
                'catatan' => $request->catatan,
            ]);

            // Create detail pesanan
            foreach ($keranjangs as $item) {
                DetailPesanan::create([
                    'pesanan_id' => $pesanan->id,
                    'buku_id' => $item->buku_id,
                    'jumlah' => $item->jumlah,
                    'harga' => $item->buku->harga,
                ]);

                // Update stok buku
                $buku = Buku::find($item->buku_id);
                $buku->update(['stok' => $buku->stok - $item->jumlah]);
            }

            // Clear keranjang
            Keranjang::where('user_id', auth()->id())->delete();

            DB::commit();

            return redirect()->route('user.pesanan.show', $pesanan)->with('success', 'Pesanan berhasil dibuat! Silakan upload bukti pembayaran.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Process checkout dari Beli Sekarang
     */
    public function checkoutBuyNow(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'jumlah' => 'required|integer|min:1',
            'nama_penerima' => 'required|string|max:255',
            'alamat_pengiriman' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'catatan' => 'nullable|string',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < $request->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        DB::beginTransaction();
        try {
            $totalHarga = $buku->harga * $request->jumlah;

            // Create pesanan dengan data pengiriman
            $pesanan = Pesanan::create([
                'user_id' => auth()->id(),
                'total_harga' => $totalHarga,
                'status' => 'menunggu_pembayaran',
                'nama_penerima' => $request->nama_penerima,
                'alamat_pengiriman' => $request->alamat_pengiriman,
                'no_hp' => $request->no_hp,
                'catatan' => $request->catatan,
            ]);

            // Create detail pesanan
            DetailPesanan::create([
                'pesanan_id' => $pesanan->id,
                'buku_id' => $buku->id,
                'jumlah' => $request->jumlah,
                'harga' => $buku->harga,
            ]);

            // Update stok buku
            $buku->update(['stok' => $buku->stok - $request->jumlah]);

            DB::commit();

            return redirect()->route('user.pesanan.show', $pesanan)->with('success', 'Pesanan berhasil dibuat! Silakan upload bukti pembayaran.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Pesanan $pesanan)
    {
        if ($pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        $pesanan->load(['detailPesanans.buku', 'pembayaran']);
        return view('user.pesanan.show', compact('pesanan'));
    }

    public function uploadBukti(Request $request, Pesanan $pesanan)
    {
        if ($pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $buktiPath = $request->file('bukti_transfer')->store('bukti-transfer', 'public');

        // Create or update pembayaran
        Pembayaran::updateOrCreate(
            ['pesanan_id' => $pesanan->id],
            ['bukti_transfer' => $buktiPath]
        );

        $pesanan->update(['status' => 'tunggu_konfirmasi']);

        return redirect()->route('user.pesanan.show', $pesanan)->with('success', 'Bukti transfer berhasil diupload! Menunggu konfirmasi admin.');
    }

    public function batal(Pesanan $pesanan)
    {
        if ($pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        // User hanya bisa batal jika status masih menunggu_pembayaran
        if ($pesanan->status === 'menunggu_pembayaran') {
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

                return redirect()->route('user.pesanan.index')->with('success', 'Pesanan berhasil dibatalkan!');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', 'Gagal membatalkan pesanan.');
            }
        }

        return redirect()->back()->with('error', 'Pesanan tidak dapat dibatalkan!');
    }

    public function selesai(Pesanan $pesanan)
    {
        if ($pesanan->user_id !== auth()->id()) {
            abort(403);
        }

        // User konfirmasi pesanan selesai setelah dikirim
        if ($pesanan->status === 'dikirim') {
            $pesanan->update(['status' => 'selesai']);
            return redirect()->back()->with('success', 'Pesanan selesai! Terima kasih telah berbelanja.');
        }

        return redirect()->back()->with('error', 'Pesanan tidak dapat diselesaikan!');
    }
}
