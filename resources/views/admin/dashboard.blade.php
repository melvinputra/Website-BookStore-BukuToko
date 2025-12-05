@extends('layouts.admin')

@section('title', 'Dashboard Admin')

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

    /* Stats Cards */
    .stat-card {
        background: #ffffff;
        border-radius: 18px;
        padding: 30px;
        border: 1px solid rgba(191, 0, 255, 0.1);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 120px;
        height: 120px;
        background: var(--neon-purple);
        opacity: 0.05;
        border-radius: 50%;
        transform: translate(30%, -30%);
        transition: all 0.4s ease;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 45px rgba(191, 0, 255, 0.2);
        border-color: rgba(191, 0, 255, 0.3);
    }

    .stat-card:hover::before {
        transform: translate(20%, -20%) scale(1.2);
        opacity: 0.08;
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(-5deg);
    }

    .stat-icon.purple {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(191, 0, 255, 0.3);
    }

    .stat-icon.green {
        background: var(--success-gradient);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(0, 212, 170, 0.3);
    }

    .stat-icon.blue {
        background: var(--info-gradient);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(9, 132, 227, 0.3);
    }

    .stat-icon.orange {
        background: var(--warning-gradient);
        color: #ffffff;
        box-shadow: 0 8px 20px rgba(243, 156, 18, 0.3);
    }

    .stat-label {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1a1a1a;
        line-height: 1;
        margin-bottom: 10px;
    }

    .stat-change {
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .stat-change.positive {
        color: #00b894;
    }

    .stat-change.neutral {
        color: #6c757d;
    }

    /* Quick Actions */
    .action-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
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

    /* Activity Section */
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        padding: 20px;
        border-bottom: 1px solid rgba(191, 0, 255, 0.1);
        display: flex;
        align-items: start;
        gap: 15px;
        transition: all 0.3s ease;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item:hover {
        background: rgba(191, 0, 255, 0.03);
    }

    .activity-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .activity-icon.purple {
        background: linear-gradient(135deg, rgba(191, 0, 255, 0.15) 0%, rgba(148, 0, 211, 0.15) 100%);
        color: var(--neon-purple);
    }

    .activity-icon.green {
        background: rgba(0, 212, 170, 0.15);
        color: #00b894;
    }

    .activity-icon.blue {
        background: rgba(9, 132, 227, 0.15);
        color: #0984e3;
    }

    .activity-content {
        flex: 1;
    }

    .activity-title {
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 5px;
        font-size: 0.95rem;
    }

    .activity-desc {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 5px;
    }

    .activity-time {
        font-size: 0.75rem;
        color: #9ca3af;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Info Cards */
    .info-card {
        background: linear-gradient(135deg, rgba(191, 0, 255, 0.08) 0%, rgba(148, 0, 211, 0.05) 100%);
        border-radius: 16px;
        padding: 25px;
        border: 1.5px solid rgba(191, 0, 255, 0.2);
    }

    .info-card-icon {
        font-size: 2.5rem;
        color: var(--neon-purple);
        margin-bottom: 15px;
    }

    .info-card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .info-card-text {
        font-size: 0.95rem;
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 0;
    }

    @media (max-width: 768px) {
        .welcome-title {
            font-size: 1.5rem;
        }
        
        .stat-value {
            font-size: 2rem;
        }
        
        .action-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
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
            Kelola toko buku online Anda dengan mudah. Mari kita lihat perkembangan hari ini!
        </p>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon purple">
                <i class="bi bi-book-fill"></i>
            </div>
            <div class="stat-label">Total Buku</div>
            <div class="stat-value">{{ $totalBuku }}</div>
            <div class="stat-change positive">
                <i class="bi bi-arrow-up"></i>
                <span>Koleksi lengkap</span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon green">
                <i class="bi bi-cart-check-fill"></i>
            </div>
            <div class="stat-label">Total Pesanan</div>
            <div class="stat-value">{{ $totalPesanan }}</div>
            <div class="stat-change positive">
                <i class="bi bi-arrow-up"></i>
                <span>Semua transaksi</span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon blue">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-label">Total User</div>
            <div class="stat-value">{{ $totalUser }}</div>
            <div class="stat-change positive">
                <i class="bi bi-arrow-up"></i>
                <span>Pelanggan aktif</span>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon orange">
                <i class="bi bi-bell-fill"></i>
            </div>
            <div class="stat-label">Pesanan Baru</div>
            <div class="stat-value">{{ $pesananBaru }}</div>
            <div class="stat-change {{ $pesananBaru > 0 ? 'positive' : 'neutral' }}">
                <i class="bi bi-{{ $pesananBaru > 0 ? 'arrow-up' : 'dash' }}"></i>
                <span>{{ $pesananBaru > 0 ? 'Perlu ditindak' : 'Tidak ada' }}</span>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-lightning-charge-fill me-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="action-grid">
                    <a href="{{ route('admin.kategori.create') }}" class="action-card">
                        <div class="action-card-icon">
                            <i class="bi bi-folder-plus"></i>
                        </div>
                        <div class="action-card-title">Tambah Kategori</div>
                        <p class="action-card-desc">Buat kategori buku baru untuk mengorganisir katalog</p>
                    </a>

                    <a href="{{ route('admin.buku.create') }}" class="action-card">
                        <div class="action-card-icon">
                            <i class="bi bi-book-half"></i>
                        </div>
                        <div class="action-card-title">Tambah Buku</div>
                        <p class="action-card-desc">Upload buku baru ke koleksi toko online</p>
                    </a>

                    <a href="{{ route('admin.pesanan.index') }}" class="action-card">
                        <div class="action-card-icon">
                            <i class="bi bi-list-check"></i>
                        </div>
                        <div class="action-card-title">Kelola Pesanan</div>
                        <p class="action-card-desc">Lihat dan proses pesanan dari pelanggan</p>
                    </a>

                    <a href="{{ route('admin.users') }}" class="action-card">
                        <div class="action-card-icon">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <div class="action-card-title">Kelola User</div>
                        <p class="action-card-desc">Manajemen akun pengguna dan pelanggan</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity & Info -->
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history me-2"></i>
                    Aktivitas Terkini
                </h5>
            </div>
            <div class="card-body p-0">
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-icon purple">
                            <i class="bi bi-cart-check-fill"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Pesanan Baru Diterima</div>
                            <div class="activity-desc">{{ $pesananBaru }} pesanan baru menunggu konfirmasi</div>
                            <div class="activity-time">
                                <i class="bi bi-clock"></i>
                                Hari ini
                            </div>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon green">
                            <i class="bi bi-book-fill"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Total Koleksi Buku</div>
                            <div class="activity-desc">{{ $totalBuku }} buku tersedia di katalog</div>
                            <div class="activity-time">
                                <i class="bi bi-clock"></i>
                                Update terbaru
                            </div>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon blue">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Pelanggan Terdaftar</div>
                            <div class="activity-desc">{{ $totalUser }} user aktif di platform</div>
                            <div class="activity-time">
                                <i class="bi bi-clock"></i>
                                Total saat ini
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="info-card">
            <div class="info-card-icon">
                <i class="bi bi-lightbulb-fill"></i>
            </div>
            <div class="info-card-title">Tips Hari Ini</div>
            <p class="info-card-text">
                Pastikan untuk memproses pesanan baru dengan cepat untuk meningkatkan kepuasan pelanggan. Jangan lupa untuk mengecek stok buku secara berkala.
            </p>
        </div>

        <div class="info-card mt-4">
            <div class="info-card-icon">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
            <div class="info-card-title">Performa</div>
            <p class="info-card-text">
                Total {{ $totalPesanan }} pesanan telah diproses. Terus tingkatkan kualitas pelayanan untuk hasil yang lebih baik!
            </p>
        </div>
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
