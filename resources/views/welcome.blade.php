<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>bukutoko - Toko Buku Online Terlengkap</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --neon-purple: #BF00FF;
            --light-bg: #f8f9fa;
            --card-bg: #ffffff;
            --text-dark: #1a1a1a;
            --text-gray: #6c757d;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Animated Background */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            z-index: -1;
        }
        
        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
        
        .shape {
            position: absolute;
            background: var(--neon-purple);
            opacity: 0.08;
            border-radius: 50%;
            animation: float 20s infinite ease-in-out;
        }
        
        .shape:nth-child(1) { width: 80px; height: 80px; left: 10%; top: 20%; animation-delay: 0s; }
        .shape:nth-child(2) { width: 120px; height: 120px; right: 15%; top: 40%; animation-delay: 2s; }
        .shape:nth-child(3) { width: 60px; height: 60px; left: 60%; bottom: 30%; animation-delay: 4s; }
        .shape:nth-child(4) { width: 100px; height: 100px; right: 40%; top: 60%; animation-delay: 6s; }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }
        
        /* Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 20px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
        }
        
        .navbar-custom .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--text-dark) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .navbar-custom .brand-icon {
            width: 40px;
            height: 40px;
            background: var(--neon-purple);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.5rem;
        }
        
        .btn-lime {
            background: var(--neon-purple);
            color: #ffffff;
            font-weight: 600;
            border: none;
            padding: 12px 30px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }
        
        .btn-lime:hover {
            background: #a000d6;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(191, 0, 255, 0.4);
            color: #ffffff;
        }
        
        .btn-outline-lime {
            background: transparent;
            color: var(--neon-purple);
            border: 2px solid var(--neon-purple);
            font-weight: 600;
            padding: 10px 28px;
            border-radius: 30px;
            transition: all 0.3s ease;
        }
        
        .btn-outline-lime:hover {
            background: var(--neon-purple);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(191, 0, 255, 0.4);
        }
        
        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 100px 0;
            position: relative;
        }
        
        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            line-height: 1.2;
            margin-bottom: 30px;
            color: var(--text-dark);
            animation: fadeInUp 1s ease;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            color: var(--text-gray);
            margin-bottom: 40px;
            animation: fadeInUp 1.2s ease;
        }
        
        .hero-illustration {
            position: relative;
            animation: fadeInRight 1.5s ease;
        }
        
        .book-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(191, 0, 255, 0.2);
            animation: floatCard 6s infinite ease-in-out;
        }
        
        @keyframes floatCard {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Role Cards */
        .role-section {
            padding: 80px 0;
            background: #ffffff;
        }
        
        .section-title {
            font-size: 3rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 20px;
        }
        
        .section-subtitle {
            text-align: center;
            color: var(--text-gray);
            font-size: 1.2rem;
            margin-bottom: 60px;
        }
        
        .role-card {
            background: var(--card-bg);
            border-radius: 25px;
            padding: 50px 40px;
            transition: all 0.4s ease;
            border: 2px solid #e9ecef;
            height: 100%;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }
        
        .role-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--neon-purple) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 0;
        }
        
        .role-card:hover::before {
            opacity: 0.1;
        }
        
        .role-card:hover {
            transform: translateY(-15px);
            border-color: var(--neon-purple);
            box-shadow: 0 30px 60px rgba(191, 0, 255, 0.3);
        }
        
        .role-card-content {
            position: relative;
            z-index: 1;
        }
        
        .role-icon {
            font-size: 5rem;
            margin-bottom: 30px;
            color: var(--neon-purple);
        }
        
        .role-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 20px;
        }
        
        .role-desc {
            color: var(--text-gray);
            margin-bottom: 30px;
            font-size: 1rem;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
            margin-bottom: 40px;
        }
        
        .feature-list li {
            padding: 12px 0;
            color: var(--text-gray);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .feature-list li i {
            color: var(--neon-purple);
            font-size: 1.2rem;
        }
        
        /* Features Grid */
        .features-section {
            padding: 100px 0;
        }
        
        .feature-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
            height: 100%;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            border-color: var(--neon-purple);
            box-shadow: 0 20px 40px rgba(191, 0, 255, 0.2);
        }
        
        .feature-icon {
            font-size: 3.5rem;
            color: var(--neon-purple);
            margin-bottom: 20px;
        }
        
        .feature-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .feature-desc {
            color: var(--text-gray);
            font-size: 0.95rem;
        }
        
        /* Stats Section */
        .stats-section {
            background: linear-gradient(135deg, var(--neon-purple) 0%, #8b00c7 100%);
            padding: 80px 0;
            color: #ffffff;
        }
        
        .stat-box {
            text-align: center;
        }
        
        .stat-number {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 10px;
            color: #ffffff;
        }
        
        .stat-label {
            font-size: 1.1rem;
            font-weight: 600;
            color: #ffffff;
            opacity: 0.9;
        }
        
        /* Footer */
        footer {
            background: #1a1a1a;
            padding: 60px 0 30px;
            border-top: 1px solid rgba(191, 0, 255, 0.2);
            color: #ffffff;
        }
        
        .footer-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 20px;
            color: var(--neon-purple);
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--neon-purple);
        }
        
        .social-icons a {
            color: #9ca3af;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .social-icons a:hover {
            color: var(--neon-purple);
            transform: translateY(-3px);
        }
        
        /* Popular Books Section */
        .books-section {
            padding: 100px 0;
            background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
        }

        .book-item {
            background: var(--card-bg);
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
            padding: 25px;
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
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 8px;
            line-height: 1.3;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .book-author {
            font-size: 0.9rem;
            color: var(--text-gray);
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
            color: var(--text-gray);
            font-weight: 500;
        }

        .book-price {
            font-size: 1.8rem;
            font-weight: 800;
            color: var(--neon-purple);
            margin-bottom: 18px;
            margin-top: auto;
        }

        .book-price-label {
            font-size: 0.75rem;
            color: var(--text-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .btn-buy {
            background: linear-gradient(135deg, var(--neon-purple) 0%, #9400d3 100%);
            color: #ffffff;
            font-weight: 600;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 6px 20px rgba(191, 0, 255, 0.3);
        }

        .btn-buy:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(191, 0, 255, 0.5);
            background: linear-gradient(135deg, #9400d3 0%, var(--neon-purple) 100%);
            color: #ffffff;
        }

        .sold-count {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            color: var(--text-gray);
            margin-bottom: 15px;
            padding: 8px 12px;
            background: rgba(191, 0, 255, 0.05);
            border-radius: 10px;
            border: 1px solid rgba(191, 0, 255, 0.1);
        }

        .sold-count i {
            color: var(--neon-purple);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            .section-title {
                font-size: 2rem;
            }
            .stat-number {
                font-size: 2.5rem;
            }
            .book-cover {
                height: 280px;
            }
            .book-cover img {
                width: auto;
                height: 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="animated-bg">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
    </div>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <div class="brand-icon">
                    <i class="bi bi-book-fill"></i>
                </div>
                <span>bukutoko</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: var(--neon-purple);">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-3">
                    @auth
                        <li class="nav-item">
                            <a class="btn btn-lime" href="{{ url('/dashboard') }}">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="btn btn-outline-lime" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="btn btn-lime" href="{{ route('register') }}">
                                    <i class="bi bi-person-plus"></i> Register
                                </a>
                            </li>
                        @endif
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h1 class="hero-title">
                        Find Your Dream Job Now!
                    </h1>
                    <p class="hero-subtitle">
                        Toko Buku Online Terlengkap dan Terpercaya di Indonesia. 
                        Temukan ribuan buku berkualitas dengan harga terjangkau dari berbagai kategori.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('login') }}" class="btn btn-lime btn-lg">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Mulai Belanja
                        </a>
                        <a href="#fitur" class="btn btn-outline-lime btn-lg">
                            <i class="bi bi-info-circle me-2"></i>Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-illustration">
                        <div class="book-card">
                            <div class="d-flex align-items-center gap-3 mb-4">
                                <div style="width: 60px; height: 60px; background: var(--neon-purple); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-book-fill" style="font-size: 2rem; color: #ffffff;"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">1000+ Judul Buku</h5>
                                    <small class="text-muted">Berbagai Kategori</small>
                                </div>
                            </div>
                            <div class="progress mb-3" style="height: 10px; border-radius: 10px; background: rgba(191, 0, 255, 0.2);">
                                <div class="progress-bar" style="width: 75%; background: var(--neon-purple); border-radius: 10px;"></div>
                            </div>
                            <div class="d-flex justify-content-between text-muted">
                                <small><i class="bi bi-people-fill me-2"></i>500+ Pelanggan</small>
                                <small><i class="bi bi-star-fill me-2" style="color: var(--neon-purple);"></i>4.8 Rating</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Role Selection Section -->
    <section class="role-section">
        <div class="container">
            <h2 class="section-title">Pilih Akses Anda</h2>
            <p class="section-subtitle">Masuk sebagai Admin atau User sesuai kebutuhan Anda</p>
            
            <div class="row g-4 justify-content-center">
                <!-- Admin Card -->
                <div class="col-lg-5 col-md-6">
                    <div class="role-card">
                        <div class="role-card-content text-center">
                            <i class="bi bi-shield-check role-icon"></i>
                            <h3 class="role-title">Admin Dashboard</h3>
                            <p class="role-desc">
                                Kelola toko buku, kategori, produk, dan pesanan pelanggan dengan mudah
                            </p>
                            <ul class="feature-list text-start">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Kelola Kategori Buku</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Manajemen Produk</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Kelola Pesanan</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Konfirmasi Pembayaran</span>
                                </li>
                            </ul>
                            <a href="{{ route('admin.login') }}" class="btn btn-lime btn-lg w-100">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login Admin
                            </a>
                        </div>
                    </div>
                </div>

                <!-- User Card -->
                <div class="col-lg-5 col-md-6">
                    <div class="role-card">
                        <div class="role-card-content text-center">
                            <i class="bi bi-person-circle role-icon"></i>
                            <h3 class="role-title">User / Pembeli</h3>
                            <p class="role-desc">
                                Belanja buku favorit, kelola keranjang, dan lacak pesanan Anda
                            </p>
                            <ul class="feature-list text-start">
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Katalog Buku Lengkap</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Keranjang Belanja</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Proses Checkout Mudah</span>
                                </li>
                                <li>
                                    <i class="bi bi-check-circle-fill"></i>
                                    <span>Lacak Pesanan</span>
                                </li>
                            </ul>
                            <div class="d-grid gap-3">
                                <a href="{{ route('login') }}" class="btn btn-lime btn-lg">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-outline-lime btn-lg">
                                    <i class="bi bi-person-plus me-2"></i>Daftar Akun Baru
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Popular Books Section -->
    <section class="books-section">
        <div class="container">
            <h2 class="section-title">Buku Populer & Terlaris</h2>
            <p class="section-subtitle">Pilihan favorit pembaca dari berbagai kategori</p>
            
            <div class="row g-4">
                @forelse($bukuPopuler as $buku)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="book-item">
                        <div class="book-cover">
                            @if($loop->first)
                            <div class="book-badge">Best Seller</div>
                            @elseif($loop->index == 1)
                            <div class="book-badge">Hot</div>
                            @elseif($loop->index == 2)
                            <div class="book-badge">Trending</div>
                            @else
                            <div class="book-badge">Popular</div>
                            @endif
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
                            <a href="{{ route('login') }}" class="btn btn-buy">
                                <i class="bi bi-cart-plus"></i>
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-book" style="font-size: 4rem; color: rgba(191, 0, 255, 0.3);"></i>
                        <h4 class="mt-3">Belum Ada Buku Tersedia</h4>
                        <p class="text-muted">Saat ini belum ada buku yang tersedia di katalog.</p>
                    </div>
                </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('login') }}" class="btn btn-lime btn-lg">
                    <i class="bi bi-grid-3x3-gap me-2"></i>
                    Lihat Semua Katalog Buku
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="features-section">
        <div class="container">
            <h2 class="section-title">Mengapa Memilih bukutoko?</h2>
            <p class="section-subtitle">Kemudahan dan kenyamanan berbelanja buku online</p>
            
            <div class="row g-4">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="feature-card">
                        <i class="bi bi-truck feature-icon"></i>
                        <h5 class="feature-title">Pengiriman Cepat</h5>
                        <p class="feature-desc">
                            Buku sampai dengan aman dan tepat waktu ke seluruh Indonesia
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="feature-card">
                        <i class="bi bi-shield-check feature-icon"></i>
                        <h5 class="feature-title">Pembayaran Aman</h5>
                        <p class="feature-desc">
                            Sistem pembayaran yang terpercaya dan terlindungi
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="feature-card">
                        <i class="bi bi-headset feature-icon"></i>
                        <h5 class="feature-title">Customer Service</h5>
                        <p class="feature-desc">
                            Siap membantu Anda kapan saja untuk pengalaman terbaik
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="feature-card">
                        <i class="bi bi-tags feature-icon"></i>
                        <h5 class="feature-title">Harga Terjangkau</h5>
                        <p class="feature-desc">
                            Dapatkan buku berkualitas dengan harga yang kompetitif
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="feature-card">
                        <i class="bi bi-collection feature-icon"></i>
                        <h5 class="feature-title">Koleksi Lengkap</h5>
                        <p class="feature-desc">
                            Ribuan judul buku dari berbagai kategori dan genre
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="feature-card">
                        <i class="bi bi-star-fill feature-icon"></i>
                        <h5 class="feature-title">Buku Terpilih</h5>
                        <p class="feature-desc">
                            Rekomendasi buku pilihan terbaik setiap minggunya
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="stat-box">
                        <div class="stat-number">1000+</div>
                        <p class="stat-label">Judul Buku</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="stat-box">
                        <div class="stat-number">500+</div>
                        <p class="stat-label">Pelanggan</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="stat-box">
                        <div class="stat-number">50+</div>
                        <p class="stat-label">Kategori</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <div class="stat-box">
                        <div class="stat-number">4.8</div>
                        <p class="stat-label">Rating</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <h5 class="footer-title">
                        <i class="bi bi-book-fill"></i> bukutoko
                    </h5>
                    <p style="color: var(--text-gray);">
                        Toko Buku Online Terlengkap dan Terpercaya di Indonesia. 
                        Temukan buku favorit Anda dengan mudah dan cepat.
                    </p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="footer-title" style="font-size: 1.1rem;">Quick Links</h6>
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Kontak</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 class="footer-title" style="font-size: 1.1rem;">Kategori</h6>
                    <ul class="footer-links">
                        <li><a href="#">Fiksi</a></li>
                        <li><a href="#">Non-Fiksi</a></li>
                        <li><a href="#">Teknologi</a></li>
                        <li><a href="#">Bisnis</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <h6 class="footer-title" style="font-size: 1.1rem;">Follow Us</h6>
                    <div class="social-icons d-flex gap-3 mb-3">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                    <p style="color: #9ca3af; font-size: 0.9rem;">
                        <i class="bi bi-envelope me-2"></i>info@bukutoko.com<br>
                        <i class="bi bi-telephone me-2"></i>+62 812-3456-7890
                    </p>
                </div>
            </div>
            <hr style="border-color: rgba(191, 0, 255, 0.2); margin: 40px 0 20px;">
            <div class="text-center">
                <p class="mb-0" style="color: #9ca3af;">
                    &copy; {{ date('Y') }} bukutoko. All rights reserved. Made with 
                    <i class="bi bi-heart-fill" style="color: var(--neon-purple);"></i> 
                    in Indonesia
                </p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
