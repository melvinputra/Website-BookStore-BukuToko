@extends('layouts.user')

@section('title', $buku->judul)

@push('styles')
<style>
    :root {
        --neon-purple: #BF00FF;
        --purple-dark: #9400d3;
    }

    .breadcrumb {
        background: rgba(191, 0, 255, 0.05);
        padding: 15px 20px;
        border-radius: 12px;
        border: 1px solid rgba(191, 0, 255, 0.1);
        margin-bottom: 30px;
    }

    .breadcrumb-item a {
        color: var(--neon-purple);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: var(--purple-dark);
    }

    .breadcrumb-item.active {
        color: #6c757d;
    }

    .book-image-wrapper {
        background: #ffffff;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(191, 0, 255, 0.1);
        position: sticky;
        top: 100px;
    }

    .book-image-wrapper img {
        width: 100%;
        height: auto;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .book-placeholder {
        background: linear-gradient(135deg, rgba(191, 0, 255, 0.1) 0%, rgba(148, 0, 211, 0.08) 100%);
        padding: 80px;
        border-radius: 15px;
        text-align: center;
        color: var(--neon-purple);
    }

    .book-details {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(191, 0, 255, 0.1);
    }

    .book-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 15px;
        line-height: 1.2;
    }

    .book-author {
        font-size: 1.2rem;
        color: #6c757d;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .category-badge {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        color: #ffffff;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
        box-shadow: 0 4px 15px rgba(191, 0, 255, 0.3);
    }

    .info-table {
        background: rgba(191, 0, 255, 0.03);
        border-radius: 15px;
        padding: 25px;
        border: 1px solid rgba(191, 0, 255, 0.1);
        margin: 30px 0;
    }

    .info-table table {
        margin-bottom: 0;
    }

    .info-table th {
        color: var(--neon-purple);
        font-weight: 700;
        font-size: 0.95rem;
        border: none;
        padding: 12px 15px;
    }

    .info-table td {
        color: #4B5563;
        font-weight: 600;
        border: none;
        padding: 12px 15px;
    }

    .info-table tr {
        border-bottom: 1px solid rgba(191, 0, 255, 0.1);
    }

    .info-table tr:last-child {
        border-bottom: none;
    }

    .price-section {
        background: linear-gradient(135deg, rgba(191, 0, 255, 0.1) 0%, rgba(148, 0, 211, 0.05) 100%);
        padding: 25px;
        border-radius: 15px;
        border: 2px solid rgba(191, 0, 255, 0.2);
        margin: 30px 0;
        text-align: center;
    }

    .price-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
    }

    .price-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--neon-purple);
        margin: 0;
    }

    .btn-add-cart {
        background: linear-gradient(135deg, #00d4aa 0%, #00b894 100%);
        color: #ffffff;
        font-weight: 700;
        border: none;
        padding: 16px 30px;
        border-radius: 15px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(0, 212, 170, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex: 1;
    }

    .btn-add-cart:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0, 212, 170, 0.5);
        background: linear-gradient(135deg, #00b894 0%, #00d4aa 100%);
        color: #ffffff;
    }

    .btn-add-cart i {
        font-size: 1.3rem;
    }

    .btn-buy-now {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        color: #ffffff;
        font-weight: 700;
        border: none;
        padding: 16px 30px;
        border-radius: 15px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(191, 0, 255, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        flex: 1;
        text-decoration: none;
    }

    .btn-buy-now:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(191, 0, 255, 0.5);
        background: linear-gradient(135deg, var(--purple-dark) 0%, #6B21A8 100%);
        color: #ffffff;
    }

    .btn-buy-now i {
        font-size: 1.3rem;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .qty-section {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .qty-label {
        font-weight: 700;
        color: #374151;
        font-size: 0.95rem;
    }

    .qty-input-group {
        display: flex;
        align-items: center;
        border: 2px solid rgba(191, 0, 255, 0.3);
        border-radius: 12px;
        overflow: hidden;
        background: white;
    }

    .qty-btn {
        width: 45px;
        height: 45px;
        border: none;
        background: rgba(191, 0, 255, 0.05);
        color: var(--neon-purple);
        font-size: 1.3rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .qty-btn:hover {
        background: rgba(191, 0, 255, 0.15);
    }

    .qty-btn:disabled {
        color: #ccc;
        cursor: not-allowed;
    }

    .qty-input {
        width: 60px;
        height: 45px;
        border: none;
        text-align: center;
        font-weight: 700;
        font-size: 1.1rem;
        color: #374151;
    }

    .qty-input:focus {
        outline: none;
    }

    .btn-disabled {
        background: #e9ecef;
        color: #6c757d;
        font-weight: 700;
        border: none;
        padding: 18px 50px;
        border-radius: 15px;
        font-size: 1.2rem;
        width: 100%;
        cursor: not-allowed;
    }

    .description-section {
        margin-top: 40px;
        padding-top: 40px;
        border-top: 2px solid rgba(191, 0, 255, 0.1);
    }

    .description-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .description-title i {
        color: var(--neon-purple);
    }

    .description-text {
        color: #4B5563;
        font-size: 1rem;
        line-height: 1.8;
    }

    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 15px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .stock-badge.available {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .stock-badge.unavailable {
        background: rgba(239, 68, 68, 0.1);
        color: #DC2626;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }
</style>
@endpush

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('user.dashboard') }}">
                    <i class="bi bi-house-fill me-1"></i>Home
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('user.buku.index') }}">
                    <i class="bi bi-book-fill me-1"></i>Katalog Buku
                </a>
            </li>
            <li class="breadcrumb-item active">{{ Str::limit($buku->judul, 50) }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="book-image-wrapper">
                @if($buku->gambar && $buku->gambar !== 'default.jpg')
                    <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}">
                @else
                    <div class="book-placeholder">
                        <i class="bi bi-book display-1"></i>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-8">
            <div class="book-details">
                <h1 class="book-title">{{ $buku->judul }}</h1>
                <p class="book-author">
                    <i class="bi bi-person-fill"></i>
                    oleh {{ $buku->penulis }}
                </p>
                
                <div class="mb-4">
                    <span class="category-badge">
                        <i class="bi bi-tag-fill me-1"></i>
                        {{ $buku->kategori->nama ?? 'Umum' }}
                    </span>
                </div>

                <div class="info-table">
                    <table class="table">
                        <tr>
                            <th width="150">
                                <i class="bi bi-upc-scan me-2"></i>ISBN
                            </th>
                            <td>{{ $buku->isbn }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-building me-2"></i>Penerbit
                            </th>
                            <td>{{ $buku->penerbit }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-calendar-event me-2"></i>Tahun Terbit
                            </th>
                            <td>{{ $buku->tahun }}</td>
                        </tr>
                        <tr>
                            <th>
                                <i class="bi bi-box-seam me-2"></i>Stok
                            </th>
                            <td>
                                <span class="stock-badge {{ $buku->stok > 0 ? 'available' : 'unavailable' }}">
                                    <i class="bi bi-{{ $buku->stok > 0 ? 'check-circle-fill' : 'x-circle-fill' }}"></i>
                                    {{ $buku->stok }} {{ $buku->stok > 0 ? 'tersedia' : 'habis' }}
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="price-section">
                    <div class="price-label">Harga</div>
                    <h2 class="price-value">Rp {{ number_format($buku->harga, 0, ',', '.') }}</h2>
                </div>

                @if($buku->stok > 0)
                    <!-- Quantity Section -->
                    <div class="qty-section">
                        <span class="qty-label">Jumlah:</span>
                        <div class="qty-input-group">
                            <button type="button" class="qty-btn" id="qtyMinus" onclick="updateQty(-1)">-</button>
                            <input type="number" class="qty-input" id="qtyInput" name="jumlah" value="1" min="1" max="{{ $buku->stok }}" readonly>
                            <button type="button" class="qty-btn" id="qtyPlus" onclick="updateQty(1)">+</button>
                        </div>
                        <span class="text-muted" style="font-size: 0.9rem;">(Maks: {{ $buku->stok }})</span>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <form action="{{ route('user.keranjang.store', $buku) }}" method="POST" style="flex: 1;" id="formKeranjang">
                            @csrf
                            <input type="hidden" name="jumlah" id="cartQty" value="1">
                            <button type="submit" class="btn-add-cart w-100">
                                <i class="bi bi-cart-plus-fill"></i>
                                Keranjang
                            </button>
                        </form>
                        
                        <a href="{{ route('user.pesanan.buynow.show', $buku) }}?jumlah=1" class="btn-buy-now" id="buyNowBtn">
                            <i class="bi bi-bag-check-fill"></i>
                            Beli Sekarang
                        </a>
                    </div>
                @else
                    <button class="btn-disabled" disabled>
                        <i class="bi bi-x-circle me-2"></i>Stok Habis
                    </button>
                @endif

                <div class="description-section">
                    <h5 class="description-title">
                        <i class="bi bi-file-text-fill"></i>
                        Deskripsi Buku
                    </h5>
                    <p class="description-text">{{ $buku->deskripsi ?? 'Tidak ada deskripsi untuk buku ini.' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const maxStok = {{ $buku->stok ?? 0 }};
    const baseUrl = "{{ route('user.pesanan.buynow.show', $buku) }}";
    
    function updateQty(change) {
        const input = document.getElementById('qtyInput');
        const cartQty = document.getElementById('cartQty');
        const buyNowBtn = document.getElementById('buyNowBtn');
        let currentValue = parseInt(input.value) || 1;
        let newValue = currentValue + change;
        
        if (newValue < 1) newValue = 1;
        if (newValue > maxStok) newValue = maxStok;
        
        input.value = newValue;
        cartQty.value = newValue;
        
        // Update Buy Now link with quantity
        buyNowBtn.href = baseUrl + "?jumlah=" + newValue;
        
        // Update button states
        document.getElementById('qtyMinus').disabled = newValue <= 1;
        document.getElementById('qtyPlus').disabled = newValue >= maxStok;
    }
    
    // Initialize button states
    document.addEventListener('DOMContentLoaded', function() {
        updateQty(0);
    });
</script>
@endpush
