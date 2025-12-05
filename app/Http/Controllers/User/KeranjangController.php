<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Keranjang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjangs = Keranjang::where('user_id', auth()->id())
            ->with('buku')
            ->get();
        
        $total = $keranjangs->sum(function($item) {
            return $item->buku->harga * $item->jumlah;
        });

        return view('user.keranjang.index', compact('keranjangs', 'total'));
    }

    public function store(Buku $buku)
    {
        $keranjang = Keranjang::where('user_id', auth()->id())
            ->where('buku_id', $buku->id)
            ->first();

        if ($keranjang) {
            $keranjang->update(['jumlah' => $keranjang->jumlah + 1]);
        } else {
            Keranjang::create([
                'user_id' => auth()->id(),
                'buku_id' => $buku->id,
                'jumlah' => 1,
            ]);
        }

        return redirect()->route('user.keranjang.index')->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, Keranjang $keranjang)
    {
        if ($keranjang->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
        ]);

        $keranjang->update($validated);

        return redirect()->route('user.keranjang.index')->with('success', 'Jumlah berhasil diupdate!');
    }

    public function destroy(Keranjang $keranjang)
    {
        if ($keranjang->user_id !== auth()->id()) {
            abort(403);
        }

        $keranjang->delete();

        return redirect()->route('user.keranjang.index')->with('success', 'Buku berhasil dihapus dari keranjang!');
    }
}
