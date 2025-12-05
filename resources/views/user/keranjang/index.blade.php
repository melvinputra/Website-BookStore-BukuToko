@extends('layouts.user')

@section('title', 'Keranjang Belanja')

@push('styles')
<style>
    :root {
        --neon-purple: #BF00FF;
        --purple-dark: #9400d3;
    }

    .page-header {
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(191, 0, 255, 0.1);
    }

    .page-title-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(191, 0, 255, 0.3);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a1a;
        margin: 0;
    }

    .cart-table {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(191, 0, 255, 0.1);
    }

    .cart-table thead {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
    }

    .cart-table thead th {
        color: #ffffff;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 18px 20px;
        border: none;
    }

    .cart-table tbody td {
        padding: 20px;
        vertical-align: middle;
        border-bottom: 1px solid #F3F4F6;
        color: #4B5563;
    }

    .cart-table tbody tr:hover {
        background: rgba(191, 0, 255, 0.03);
    }

    .book-info strong {
        color: #1a1a1a;
        font-size: 1rem;
        font-weight: 700;
    }

    .book-info small {
        color: #6c757d;
    }

    .price-tag {
        font-weight: 700;
        color: var(--neon-purple);
        font-size: 1.1rem;
    }

    .total-row {
        background: rgba(191, 0, 255, 0.05);
        font-weight: 700;
    }

    .total-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--neon-purple);
    }

    .btn-update {
        background: linear-gradient(135deg, #fdcb6e 0%, #f39c12 100%);
        color: #ffffff;
        border: none;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(243, 156, 18, 0.4);
        color: #ffffff;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
        color: #ffffff;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(238, 90, 111, 0.4);
        color: #ffffff;
    }

    .btn-continue {
        background: rgba(191, 0, 255, 0.1);
        color: var(--neon-purple);
        border: 2px solid var(--neon-purple);
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 700;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-continue:hover {
        background: var(--neon-purple);
        color: #ffffff;
        transform: translateY(-2px);
    }

    .btn-checkout {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        color: #ffffff;
        border: none;
        padding: 12px 40px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 6px 20px rgba(191, 0, 255, 0.3);
    }

    .btn-checkout:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(191, 0, 255, 0.5);
        color: #ffffff;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: rgba(191, 0, 255, 0.03);
        border-radius: 16px;
        border: 1.5px dashed rgba(191, 0, 255, 0.2);
    }

    .empty-state i {
        font-size: 5rem;
        color: rgba(191, 0, 255, 0.3);
        margin-bottom: 20px;
    }

    .empty-state h4 {
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .empty-state a {
        color: var(--neon-purple);
        font-weight: 700;
        text-decoration: none;
    }

    .empty-state a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title-wrapper">
            <div class="page-icon">
                <i class="bi bi-cart-fill"></i>
            </div>
            <h1 class="page-title">Keranjang Belanja</h1>
        </div>
    </div>

    @if($keranjangs->isEmpty())
        <div class="empty-state">
            <i class="bi bi-cart-x"></i>
            <h4>Keranjang Anda Kosong</h4>
            <p class="text-muted">Mulai belanja dan tambahkan buku favorit Anda ke keranjang.</p>
            <a href="{{ route('user.buku.index') }}" class="btn-continue mt-3">
                <i class="bi bi-arrow-left"></i> Belanja Sekarang
            </a>
        </div>
    @else
        <div class="cart-table">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th width="40%">Buku</th>
                        <th width="15%">Harga</th>
                        <th width="20%">Jumlah</th>
                        <th width="15%">Subtotal</th>
                        <th width="10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keranjangs as $item)
                        <tr>
                            <td>
                                <div class="book-info">
                                    <strong>{{ $item->buku->judul }}</strong><br>
                                    <small><i class="bi bi-person me-1"></i>{{ $item->buku->penulis }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="price-tag">Rp {{ number_format($item->buku->harga, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <form action="{{ route('user.keranjang.update', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <div class="input-group" style="width: 160px;">
                                        <input type="number" name="jumlah" value="{{ $item->jumlah }}" min="1" max="{{ $item->buku->stok }}" class="form-control" style="border-color: rgba(191, 0, 255, 0.3);">
                                        <button type="submit" class="btn-update">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <span class="price-tag">Rp {{ number_format($item->buku->harga * $item->jumlah, 0, ',', '.') }}</span>
                            </td>
                            <td>
                                <form action="{{ route('user.keranjang.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Hapus dari keranjang?')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="total-row">
                        <td colspan="3" class="text-end" style="font-size: 1.1rem;">
                            <i class="bi bi-calculator me-2"></i>Total Pembayaran:
                        </td>
                        <td colspan="2">
                            <span class="total-price">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('user.buku.index') }}" class="btn-continue">
                <i class="bi bi-arrow-left"></i> Lanjut Belanja
            </a>
            <a href="{{ route('user.pesanan.checkout.show') }}" class="btn-checkout">
                <i class="bi bi-credit-card me-2"></i> Checkout Sekarang
            </a>
        </div>
    @endif
</div>
@endsection
