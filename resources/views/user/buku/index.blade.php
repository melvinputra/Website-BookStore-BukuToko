@extends('layouts.user')

@section('title', 'Katalog Buku')

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

    .page-subtitle {
        color: #6c757d;
        margin: 0;
        font-size: 1rem;
    }

    .book-item {
        background: #ffffff;
        border-radius: 20px;
        padding: 0;
        overflow: hidden;
        border: 1px solid #e9ecef;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .book-item:hover {
        transform: translateY(-12px);
        border-color: var(--neon-purple);
        box-shadow: 0 20px 50px rgba(191, 0, 255, 0.25);
    }

    .book-cover {
        position: relative;
        width: 100%;
        height: 320px;
        overflow: hidden;
        background: linear-gradient(135deg, #e9ecef 0%, #f8f9fa 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .book-cover img {
        width: auto;
        height: 100%;
        max-width: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.4s ease;
    }

    .book-item:hover .book-cover img {
        transform: scale(1.08);
    }

    .book-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, rgba(191, 0, 255, 0.1) 0%, rgba(148, 0, 211, 0.08) 100%);
        color: var(--neon-purple);
        font-size: 4rem;
    }

    .book-content {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .book-category {
        font-size: 0.8rem;
        color: var(--neon-purple);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .book-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .book-author {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .sold-count {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 15px;
        padding: 8px 12px;
        background: rgba(191, 0, 255, 0.05);
        border-radius: 10px;
        border: 1px solid rgba(191, 0, 255, 0.1);
    }

    .sold-count i {
        color: var(--neon-purple);
    }

    .book-price-label {
        font-size: 0.75rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .book-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--neon-purple);
        margin-bottom: 15px;
        margin-top: auto;
    }

    .btn-detail {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        color: #ffffff;
        font-weight: 600;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 6px 20px rgba(191, 0, 255, 0.3);
        text-decoration: none;
        margin-bottom: 8px;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(191, 0, 255, 0.5);
        color: #ffffff;
    }

    .btn-cart {
        background: linear-gradient(135deg, #00d4aa 0%, #00b894 100%);
        color: #ffffff;
        font-weight: 600;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        box-shadow: 0 6px 20px rgba(0, 212, 170, 0.3);
    }

    .btn-cart:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0, 212, 170, 0.5);
        background: linear-gradient(135deg, #00b894 0%, #00d4aa 100%);
        color: #ffffff;
    }

    .btn-disabled {
        background: #e9ecef;
        color: #6c757d;
        font-weight: 600;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        width: 100%;
        cursor: not-allowed;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: rgba(191, 0, 255, 0.03);
        border-radius: 16px;
        border: 1.5px dashed rgba(191, 0, 255, 0.2);
    }

    .empty-state i {
        font-size: 4rem;
        color: rgba(191, 0, 255, 0.3);
        margin-bottom: 20px;
    }

    /* Search Styles */
    .search-wrapper {
        background: #ffffff;
        border-radius: 20px;
        padding: 24px;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(191, 0, 255, 0.1);
    }

    .search-form {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .search-input-group {
        flex: 1;
        min-width: 250px;
    }

    .search-input-group label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    .search-input {
        width: 100%;
        padding: 14px 20px;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--neon-purple);
        box-shadow: 0 0 0 4px rgba(191, 0, 255, 0.1);
    }

    .search-select {
        width: 100%;
        padding: 14px 20px;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #ffffff;
        cursor: pointer;
    }

    .search-select:focus {
        outline: none;
        border-color: var(--neon-purple);
        box-shadow: 0 0 0 4px rgba(191, 0, 255, 0.1);
    }

    .btn-search {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        border: none;
        color: #ffffff;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 6px 20px rgba(191, 0, 255, 0.3);
    }

    .btn-search:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(191, 0, 255, 0.4);
    }

    .btn-reset {
        background: #F3F4F6;
        border: 2px solid #E5E7EB;
        color: #6B7280;
        padding: 14px 28px;
        border-radius: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-reset:hover {
        background: #E5E7EB;
        color: #374151;
        transform: translateY(-2px);
    }

    .search-results-info {
        margin-bottom: 20px;
        padding: 16px 24px;
        background: rgba(191, 0, 255, 0.05);
        border-radius: 12px;
        border-left: 4px solid var(--neon-purple);
        color: #6B7280;
        font-size: 0.95rem;
    }

    .search-results-info strong {
        color: var(--neon-purple);
    }

    @media (max-width: 768px) {
        .search-form {
            flex-direction: column;
        }
        .search-input-group {
            min-width: 100%;
        }
        .btn-search, .btn-reset {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title-wrapper">
            <div class="page-icon">
                <i class="bi bi-book-fill"></i>
            </div>
            <div>
                <h1 class="page-title">Katalog Buku</h1>
                <p class="page-subtitle">Temukan buku favorit Anda dari koleksi kami</p>
            </div>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="search-wrapper">
        <form action="{{ route('user.buku.index') }}" method="GET" class="search-form">
            <div class="search-input-group">
                <label for="search"><i class="bi bi-search me-2"></i>Cari Buku</label>
                <input type="text" name="search" id="search" class="search-input" 
                       placeholder="Cari judul, penulis, atau penerbit..." 
                       value="{{ request('search') }}">
            </div>
            <div class="search-input-group" style="max-width: 220px;">
                <label for="kategori"><i class="bi bi-folder me-2"></i>Kategori</label>
                <select name="kategori" id="kategori" class="search-select">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-search">
                <i class="bi bi-search"></i>
                <span>Cari</span>
            </button>
            @if(request('search') || request('kategori'))
                <a href="{{ route('user.buku.index') }}" class="btn-reset">
                    <i class="bi bi-x-circle"></i>
                    <span>Reset</span>
                </a>
            @endif
        </form>
    </div>

    @if(request('search') || request('kategori'))
        <div class="search-results-info">
            <i class="bi bi-info-circle me-2"></i>
            Menampilkan <strong>{{ $bukus->count() }}</strong> hasil
            @if(request('search'))
                untuk pencarian "<strong>{{ request('search') }}</strong>"
            @endif
            @if(request('kategori'))
                @php $selectedKategori = $kategoris->find(request('kategori')); @endphp
                @if($selectedKategori)
                    dalam kategori "<strong>{{ $selectedKategori->nama }}</strong>"
                @endif
            @endif
        </div>
    @endif

    <div class="row g-4">
        @forelse($bukus as $buku)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="book-item">
                    <div class="book-cover">
                        @if($buku->gambar && $buku->gambar !== 'default.jpg')
                            <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}">
                        @else
                            <div class="book-placeholder">
                                <i class="bi bi-book"></i>
                            </div>
                        @endif
                    </div>
                    <div class="book-content">
                        @if($buku->kategori)
                            <div class="book-category">{{ $buku->kategori->nama }}</div>
                        @endif
                        <h5 class="book-title">{{ $buku->judul }}</h5>
                        <p class="book-author">
                            <i class="bi bi-person-fill"></i>
                            {{ $buku->penulis }}
                        </p>
                        <div class="sold-count">
                            <i class="bi bi-box-seam"></i>
                            <span>Stok: {{ $buku->stok }}</span>
                        </div>
                        <div class="book-price-label">Harga</div>
                        <div class="book-price">Rp {{ number_format($buku->harga, 0, ',', '.') }}</div>
                        <a href="{{ route('user.buku.show', $buku) }}" class="btn-detail">
                            <i class="bi bi-eye-fill"></i> Lihat Detail
                        </a>
                        @if($buku->stok > 0)
                            <form action="{{ route('user.keranjang.store', $buku) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-cart">
                                    <i class="bi bi-cart-plus-fill"></i> Tambah ke Keranjang
                                </button>
                            </form>
                        @else
                            <button class="btn-disabled" disabled>
                                <i class="bi bi-x-circle"></i> Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-book"></i>
                    <h4>Belum Ada Buku Tersedia</h4>
                    <p class="text-muted">Saat ini belum ada buku yang tersedia di katalog.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
