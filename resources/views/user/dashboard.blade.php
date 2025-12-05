@extends('layouts.user')

@section('title', 'Dashboard')

@push('styles')
<style>
    :root {
        --neon-purple: #BF00FF;
        --purple-dark: #9400d3;
        --success-gradient: linear-gradient(135deg, #00d4aa 0%, #00b894 100%);
        --warning-gradient: linear-gradient(135deg, #fdcb6e 0%, #f39c12 100%);
        --info-gradient: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
        --danger-gradient: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
    }

    .welcome-banner {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        border-radius: 20px;
        padding: 35px 40px;
        color: #ffffff;
        margin-bottom: 35px;
        box-shadow: 0 15px 40px rgba(191, 0, 255, 0.3);
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -5%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-title {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .welcome-icon {
        width: 60px;
        height: 60px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    .welcome-subtitle {
        font-size: 1.1rem;
        opacity: 0.95;
        margin-bottom: 0;
    }

    .welcome-time {
        font-size: 0.9rem;
        opacity: 0.85;
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Quick Action Cards */
    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 35px;
    }

    .action-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 25px;
        border: 1.5px solid rgba(191, 0, 255, 0.15);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
        position: relative;
        overflow: hidden;
    }

    .action-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(191, 0, 255, 0.2);
        border-color: var(--neon-purple);
        color: inherit;
    }

    .action-card:hover::before {
        opacity: 0.05;
    }

    .action-card-icon {
        width: 55px;
        height: 55px;
        background: linear-gradient(135deg, rgba(191, 0, 255, 0.1) 0%, rgba(148, 0, 211, 0.1) 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--neon-purple);
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .action-card:hover .action-card-icon {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        color: #ffffff;
        transform: scale(1.1);
    }

    .action-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #1a1a1a;
    }

    .action-card-desc {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 0;
        line-height: 1.5;
    }

    /* Book Cards */
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

    .book-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: linear-gradient(135deg, var(--neon-purple) 0%, #9400d3 100%);
        color: #ffffff;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(191, 0, 255, 0.4);
        z-index: 2;
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

    .book-rating {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 15px;
    }

    .stars {
        color: #ffc107;
        font-size: 0.9rem;
    }

    .rating-text {
        font-size: 0.85rem;
        color: #6c757d;
        font-weight: 500;
    }

    .book-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--neon-purple);
        margin-bottom: 15px;
        margin-top: auto;
    }

    .book-price-label {
        font-size: 0.75rem;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .btn-buy {
        background: linear-gradient(135deg, var(--neon-purple) 0%, #9400d3 100%);
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
    }

    .btn-buy:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(191, 0, 255, 0.5);
        background: linear-gradient(135deg, #9400d3 0%, var(--neon-purple) 100%);
        color: #ffffff;
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

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(191, 0, 255, 0.1);
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1a1a1a;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.3rem;
    }

    .btn-view-all {
        background: linear-gradient(135deg, rgba(191, 0, 255, 0.1) 0%, rgba(148, 0, 211, 0.08) 100%);
        color: var(--neon-purple);
        border: 1.5px solid rgba(191, 0, 255, 0.3);
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-view-all:hover {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        color: #ffffff;
        transform: translateX(5px);
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

    .empty-state-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .empty-state-text {
        color: #6c757d;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .welcome-title {
            font-size: 1.5rem;
        }
        
        .action-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <!-- Welcome Banner -->
    <div class="welcome-banner">
        <div class="welcome-content">
            <div class="welcome-title">
                <div class="welcome-icon">
                    <i class="bi bi-emoji-smile"></i>
                </div>
                <div>
                    <div>Selamat Datang, {{ auth()->user()->nama }}! 👋</div>
                    <div class="welcome-time">
                        <i class="bi bi-clock"></i>
                        <span id="currentDateTime"></span>
                    </div>
                </div>
            </div>
            <p class="welcome-subtitle">
                Temukan buku favorit Anda dan mulai petualangan membaca yang menyenangkan!
            </p>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="action-grid">
        <a href="{{ route('user.buku.index') }}" class="action-card">
            <div class="action-card-icon">
                <i class="bi bi-book-half"></i>
            </div>
            <div class="action-card-title">Jelajahi Buku</div>
            <p class="action-card-desc">Lihat katalog lengkap buku yang tersedia</p>
        </a>

        <a href="{{ route('user.keranjang.index') }}" class="action-card">
            <div class="action-card-icon">
                <i class="bi bi-cart3"></i>
            </div>
            <div class="action-card-title">Keranjang Saya</div>
            <p class="action-card-desc">Kelola item di keranjang belanja Anda</p>
        </a>

        <a href="{{ route('user.pesanan.index') }}" class="action-card">
            <div class="action-card-icon">
                <i class="bi bi-receipt"></i>
            </div>
            <div class="action-card-title">Pesanan Saya</div>
            <p class="action-card-desc">Lihat riwayat dan status pesanan</p>
        </a>

        <a href="{{ route('user.dashboard') }}" class="action-card">
            <div class="action-card-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <div class="action-card-title">Akun Saya</div>
            <p class="action-card-desc">Kelola akun dan informasi pengguna</p>
        </a>
    </div>

    <!-- Featured Books Section -->
    <div class="section-header">
        <div class="section-title">
            <div class="section-icon">
                <i class="bi bi-stars"></i>
            </div>
            <span>Buku Pilihan</span>
        </div>
        <a href="{{ route('user.buku.index') }}" class="btn-view-all">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

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
                        @if($buku->stok > 0)
                            <div class="sold-count">
                                <i class="bi bi-box-seam"></i>
                                <span>Stok: {{ $buku->stok }}</span>
                            </div>
                        @endif
                        <div class="book-price-label">Harga</div>
                        <div class="book-price">Rp {{ number_format($buku->harga, 0, ',', '.') }}</div>
                        <a href="{{ route('user.buku.show', $buku) }}" class="btn-buy">
                            <i class="bi bi-eye-fill"></i> Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-book"></i>
                    <div class="empty-state-title">Belum Ada Buku Tersedia</div>
                    <p class="empty-state-text">Saat ini belum ada buku yang tersedia di katalog. Silakan cek kembali nanti.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateDateTime() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        const dateTimeString = now.toLocaleDateString('id-ID', options);
        document.getElementById('currentDateTime').textContent = dateTimeString;
    }

    updateDateTime();
    setInterval(updateDateTime, 60000); // Update setiap menit
</script>
@endpush
