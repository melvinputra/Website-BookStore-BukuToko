<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User - BukuKita')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --neon-purple: #BF00FF;
            --purple-dark: #9400d3;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
        }

        .navbar-custom {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
            padding: 15px 0;
            border-bottom: 1px solid rgba(191, 0, 255, 0.1);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: #1a1a1a !important;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--neon-purple) !important;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.3rem;
            box-shadow: 0 4px 15px rgba(191, 0, 255, 0.3);
        }

        .navbar-nav .nav-link {
            color: #4B5563 !important;
            font-weight: 600;
            padding: 10px 18px !important;
            border-radius: 10px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
        }

        .navbar-nav .nav-link:hover {
            color: var(--neon-purple) !important;
            background: rgba(191, 0, 255, 0.08);
            transform: translateY(-2px);
        }

        .navbar-nav .nav-link.active {
            color: var(--neon-purple) !important;
            background: rgba(191, 0, 255, 0.12);
        }

        .navbar-nav .nav-link i {
            font-size: 1.1rem;
        }

        .user-dropdown .dropdown-toggle {
            background: linear-gradient(135deg, rgba(191, 0, 255, 0.1) 0%, rgba(148, 0, 211, 0.08) 100%);
            color: var(--neon-purple) !important;
            border: 1.5px solid rgba(191, 0, 255, 0.3);
            padding: 10px 20px !important;
            font-weight: 700;
        }

        .user-dropdown .dropdown-toggle:hover {
            background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
            color: #ffffff !important;
            border-color: var(--neon-purple);
        }

        .dropdown-menu {
            border: 1px solid rgba(191, 0, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            padding: 8px;
        }

        .dropdown-item {
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            color: #4B5563;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: rgba(191, 0, 255, 0.1);
            color: var(--neon-purple);
        }

        .navbar-toggler {
            border: 2px solid var(--neon-purple);
            padding: 8px 12px;
        }

        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(191, 0, 255, 0.25);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.dashboard') }}">
                <div class="brand-icon">
                    <i class="bi bi-book-fill"></i>
                </div>
                <span>bukutoko</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                            <i class="bi bi-house-fill"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.buku.*') ? 'active' : '' }}" href="{{ route('user.buku.index') }}">
                            <i class="bi bi-book-fill"></i> Katalog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.keranjang.*') ? 'active' : '' }}" href="{{ route('user.keranjang.index') }}">
                            <i class="bi bi-cart-fill"></i> Keranjang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.pesanan.*') ? 'active' : '' }}" href="{{ route('user.pesanan.index') }}">
                            <i class="bi bi-box-seam-fill"></i> Pesanan
                        </a>
                    </li>
                    <li class="nav-item dropdown user-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ auth()->user()->nama }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('user.profil') }}">
                                    <i class="bi bi-person-gear me-2"></i>Profil Saya
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <main class="py-4">
        @yield('content')
    </main>

    <footer style="background: #1a1a1a; padding: 60px 0 30px; border-top: 1px solid rgba(191, 0, 255, 0.2); color: #ffffff; margin-top: 80px;">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 20px; color: var(--neon-purple);">
                        <i class="bi bi-book-fill"></i> bukutoko
                    </h5>
                    <p style="color: #9ca3af;">
                        Toko Buku Online Terlengkap dan Terpercaya di Indonesia. 
                        Temukan buku favorit Anda dengan mudah dan cepat.
                    </p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 20px; color: var(--neon-purple);">Quick Links</h6>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 10px;"><a href="#" style="color: #9ca3af; text-decoration: none; transition: color 0.3s ease;">Tentang Kami</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" style="color: #9ca3af; text-decoration: none; transition: color 0.3s ease;">Kontak</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" style="color: #9ca3af; text-decoration: none; transition: color 0.3s ease;">FAQ</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" style="color: #9ca3af; text-decoration: none; transition: color 0.3s ease;">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h6 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 20px; color: var(--neon-purple);">Kategori</h6>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 10px;"><a href="#" style="color: #9ca3af; text-decoration: none; transition: color 0.3s ease;">Fiksi</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" style="color: #9ca3af; text-decoration: none; transition: color 0.3s ease;">Non-Fiksi</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" style="color: #9ca3af; text-decoration: none; transition: color 0.3s ease;">Teknologi</a></li>
                        <li style="margin-bottom: 10px;"><a href="#" style="color: #9ca3af; text-decoration: none; transition: color 0.3s ease;">Bisnis</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h6 style="font-size: 1.1rem; font-weight: 700; margin-bottom: 20px; color: var(--neon-purple);">Follow Us</h6>
                    <div class="d-flex gap-3 mb-3">
                        <a href="#" style="color: #9ca3af; font-size: 1.5rem; transition: all 0.3s ease;"><i class="bi bi-facebook"></i></a>
                        <a href="#" style="color: #9ca3af; font-size: 1.5rem; transition: all 0.3s ease;"><i class="bi bi-instagram"></i></a>
                        <a href="#" style="color: #9ca3af; font-size: 1.5rem; transition: all 0.3s ease;"><i class="bi bi-twitter"></i></a>
                        <a href="#" style="color: #9ca3af; font-size: 1.5rem; transition: all 0.3s ease;"><i class="bi bi-youtube"></i></a>
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

    <!-- Floating WhatsApp Button -->
    <div class="wa-float-container">
        <a href="https://wa.me/+6287721906576?text=Halo%20Admin%20BukuToko%2C%20saya%20ingin%20bertanya%20tentang%20produk" 
           class="wa-float-btn" 
           target="_blank" 
           title="Hubungi Admin via WhatsApp"
           id="waFloatBtn">
            <i class="bi bi-whatsapp"></i>
        </a>
        <div class="wa-tooltip" id="waTooltip">
            <span>Butuh bantuan? Chat Admin</span>
            <button class="wa-tooltip-close" onclick="closeWaTooltip()">&times;</button>
        </div>
    </div>

    <style>
        .wa-float-container {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        
        .wa-float-btn {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-size: 1.8rem;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
            transition: all 0.3s ease;
            animation: pulse-wa 2s infinite;
        }
        
        .wa-float-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 30px rgba(37, 211, 102, 0.5);
            color: #ffffff;
        }
        
        @keyframes pulse-wa {
            0% {
                box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
            }
            50% {
                box-shadow: 0 6px 30px rgba(37, 211, 102, 0.6), 0 0 0 15px rgba(37, 211, 102, 0.1);
            }
            100% {
                box-shadow: 0 6px 20px rgba(37, 211, 102, 0.4);
            }
        }
        
        .wa-tooltip {
            background: white;
            padding: 12px 16px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.5s ease;
            position: absolute;
            right: 75px;
            white-space: nowrap;
        }
        
        .wa-tooltip span {
            font-weight: 600;
            color: #374151;
            font-size: 0.9rem;
        }
        
        .wa-tooltip-close {
            background: none;
            border: none;
            color: #9CA3AF;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }
        
        .wa-tooltip-close:hover {
            color: #374151;
        }
        
        .wa-tooltip.hidden {
            display: none;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @media (max-width: 576px) {
            .wa-float-container {
                bottom: 20px;
                right: 20px;
            }
            
            .wa-float-btn {
                width: 55px;
                height: 55px;
                font-size: 1.6rem;
            }
            
            .wa-tooltip {
                display: none;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        function closeWaTooltip() {
            document.getElementById('waTooltip').classList.add('hidden');
            localStorage.setItem('waTooltipClosed', 'true');
        }
        
        // Auto hide tooltip after 10 seconds
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('waTooltipClosed') === 'true') {
                document.getElementById('waTooltip').classList.add('hidden');
            } else {
                setTimeout(function() {
                    const tooltip = document.getElementById('waTooltip');
                    if (tooltip && !tooltip.classList.contains('hidden')) {
                        tooltip.classList.add('hidden');
                    }
                }, 10000);
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>
