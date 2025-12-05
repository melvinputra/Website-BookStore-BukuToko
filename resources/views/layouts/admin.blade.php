<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - bukutoko')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #8B5CF6;
            --primary-dark: #6D28D9;
            --primary-light: #A78BFA;
            --primary-glow: rgba(139, 92, 246, 0.4);
            --sidebar-bg: #0F172A;
            --sidebar-card: #1E293B;
            --sidebar-hover: #334155;
            --text-light: #94A3B8;
            --text-white: #F1F5F9;
            --border-color: #334155;
            --success: #10B981;
            --warning: #F59E0B;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #F3F4F6;
            overflow-x: hidden;
        }

        /* Unified Container */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - Terintegrasi Vertikal */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #0a0f1e 100%);
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 24px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }

        /* Brand Section di Top Sidebar */
        .sidebar-brand {
            padding: 28px 24px;
            background: var(--sidebar-bg);
            border-bottom: 1px solid var(--border-color);
        }

        .brand-content {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .brand-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #ffffff;
            box-shadow: 0 8px 16px var(--primary-glow);
            transition: all 0.3s ease;
        }

        .brand-content:hover .brand-icon {
            transform: scale(1.05);
            box-shadow: 0 12px 24px var(--primary-glow);
        }

        .brand-text {
            color: var(--text-white);
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: -0.5px;
        }

        /* Navigation Menu */
        .sidebar-nav {
            flex: 1;
            padding: 20px 0;
            overflow-y: auto;
        }

        .sidebar-nav::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar-nav::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 10px;
        }

        .nav-section {
            margin-bottom: 8px;
        }

        .nav-section-title {
            padding: 24px 24px 12px;
            font-size: 0.68rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #64748B;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-section-title::before {
            content: '';
            width: 12px;
            height: 2px;
            background: linear-gradient(90deg, var(--primary) 0%, transparent 100%);
            border-radius: 10px;
        }

        .nav-menu {
            list-style: none;
            padding: 0 16px;
            margin: 0;
        }

        .nav-item {
            margin: 0 0 4px 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 13px 16px;
            color: var(--text-light);
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
            font-weight: 600;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: var(--primary);
            transform: scaleY(0);
            transition: transform 0.3s ease;
            border-radius: 0 10px 10px 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            right: 16px;
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
            opacity: 0;
            transform: scale(0);
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: var(--sidebar-card);
            color: var(--text-white);
            transform: translateX(6px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .nav-link:hover::before {
            transform: scaleY(1);
        }

        .nav-link:hover .nav-icon-wrapper {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            transform: scale(1.1) rotate(-5deg);
        }

        .nav-link.active {
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.15) 0%, rgba(109, 40, 217, 0.1) 100%);
            color: #ffffff;
            box-shadow: 0 4px 16px var(--primary-glow);
            border: 1px solid rgba(139, 92, 246, 0.3);
        }

        .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-link.active::after {
            opacity: 1;
            transform: scale(1);
        }

        .nav-link.active .nav-icon-wrapper {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px var(--primary-glow);
        }

        .nav-icon-wrapper {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: rgba(148, 163, 184, 0.1);
            transition: all 0.3s ease;
            flex-shrink: 0;
        }

        .nav-icon {
            font-size: 1.15rem;
        }

        .nav-badge {
            margin-left: auto;
            background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
            color: #ffffff;
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
            animation: pulse-badge 2s ease-in-out infinite;
        }

        @keyframes pulse-badge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        /* User Profile Section at Bottom */
        .sidebar-footer {
            padding: 20px 16px;
            border-top: 1px solid var(--border-color);
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px;
            background: var(--sidebar-card);
            border-radius: 12px;
            margin-bottom: 12px;
            border: 1px solid rgba(139, 92, 246, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .user-profile::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .user-profile:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }

        .user-profile:hover::before {
            opacity: 1;
        }

        .user-avatar {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-weight: 700;
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 4px 12px var(--primary-glow);
            border: 2px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 1;
        }

        .user-avatar::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 12px;
            height: 12px;
            background: var(--success);
            border-radius: 50%;
            border: 2px solid var(--sidebar-card);
        }

        .user-info {
            flex: 1;
            min-width: 0;
            position: relative;
            z-index: 1;
        }

        .user-name {
            color: var(--text-white);
            font-size: 0.95rem;
            font-weight: 700;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 2px;
        }

        .user-role {
            color: var(--text-light);
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .user-role::before {
            content: '';
            width: 6px;
            height: 6px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse-dot 2s ease-in-out infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .btn-logout {
            width: 100%;
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15) 0%, rgba(220, 38, 38, 0.1) 100%);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #FCA5A5;
            padding: 12px;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 700;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
        }

        .btn-logout:hover {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.25) 0%, rgba(220, 38, 38, 0.2) 100%);
            border-color: rgba(239, 68, 68, 0.6);
            color: #FEE2E2;
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(239, 68, 68, 0.3);
        }

        .btn-logout i {
            font-size: 1.1rem;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 280px;
            flex: 1;
            min-height: 100vh;
            background: #F3F4F6;
        }

        /* Top Bar - Minimal & Clean */
        .top-bar {
            background: #ffffff;
            padding: 20px 32px;
            border-bottom: 1px solid #E5E7EB;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            backdrop-filter: blur(10px);
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            font-size: 0.9rem;
        }

        .breadcrumb-item {
            color: #6B7280;
        }

        .breadcrumb-item.active {
            color: var(--primary);
            font-weight: 600;
        }

        .breadcrumb-item a {
            color: #6B7280;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: var(--primary);
        }

        /* Content Wrapper */
        .content-wrapper {
            padding: 30px;
        }

        /* Alerts */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px 20px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #D1FAE5 0%, #A7F3D0 100%);
            color: #065F46;
            border-left: 4px solid #10B981;
        }

        .alert-danger {
            background: linear-gradient(135deg, #FEE2E2 0%, #FECACA 100%);
            color: #991B1B;
            border-left: 4px solid #EF4444;
        }

        .alert .btn-close {
            filter: none;
        }

        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            color: #ffffff;
            font-size: 1.5rem;
            box-shadow: 0 4px 12px rgba(139, 92, 246, 0.4);
            z-index: 1001;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .mobile-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .content-wrapper {
                padding: 20px;
            }

            .top-bar {
                padding: 16px 20px;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .sidebar-overlay.active {
            display: block;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <!-- Brand -->
            <div class="sidebar-brand">
                <a href="{{ route('admin.dashboard') }}" class="brand-content">
                    <div class="brand-icon">
                        <i class="bi bi-book-fill"></i>
                    </div>
                    <span class="brand-text">bukutoko</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Main Menu</div>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon bi bi-grid-fill"></i>
                                </div>
                                <span>Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Management</div>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}" href="{{ route('admin.kategori.index') }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon bi bi-folder-fill"></i>
                                </div>
                                <span>Kategori</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.buku.*') ? 'active' : '' }}" href="{{ route('admin.buku.index') }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon bi bi-book-fill"></i>
                                </div>
                                <span>Buku</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon bi bi-people-fill"></i>
                                </div>
                                <span>Users</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="nav-section">
                    <div class="nav-section-title">Orders</div>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}" href="{{ route('admin.pesanan.index') }}">
                                <div class="nav-icon-wrapper">
                                    <i class="nav-icon bi bi-bag-check-fill"></i>
                                </div>
                                <span>Pesanan</span>
                                @if(isset($pesananBaru) && $pesananBaru > 0)
                                    <span class="nav-badge">{{ $pesananBaru }}</span>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- User Profile Footer -->
            <div class="sidebar-footer">
                <div class="user-profile">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->nama }}</div>
                        <div class="user-role">Administrator</div>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-door me-1"></i>Home</a></li>
                        <li class="breadcrumb-item active">@yield('breadcrumb', 'Dashboard')</li>
                    </ol>
                </nav>
            </div>

            <!-- Content Wrapper -->
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

        <!-- Mobile Toggle Button -->
        <button class="mobile-toggle" id="mobileToggle">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile Sidebar Toggle
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const mobileToggle = document.getElementById('mobileToggle');

        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            sidebarOverlay.classList.toggle('active');
        });

        sidebarOverlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            sidebarOverlay.classList.remove('active');
        });

        // Close sidebar on navigation click (mobile)
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('active');
                    sidebarOverlay.classList.remove('active');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
