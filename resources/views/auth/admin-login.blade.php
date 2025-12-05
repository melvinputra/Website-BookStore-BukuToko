<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - bukutoko</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #BF00FF 0%, #8b00c7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
        }

        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
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

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1000px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            overflow: hidden;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Left Section */
        .left-section {
            background: linear-gradient(135deg, #BF00FF 0%, #8b00c7 100%);
            padding: 60px 50px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left-content {
            width: 100%;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 40px;
        }

        .brand-logo i {
            font-size: 2rem;
        }

        .icon-wrapper {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .icon-wrapper i {
            font-size: 3rem;
            color: white;
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .welcome-text {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 35px;
            opacity: 0.95;
        }

        .features-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
        }

        .feature-item i {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        /* Right Section */
        .right-section {
            background: white;
            padding: 60px 50px;
        }

        .form-content {
            max-width: 400px;
            margin: 0 auto;
        }

        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .login-subtitle {
            color: #6c757d;
            margin-bottom: 35px;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 18px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #BF00FF;
            box-shadow: 0 0 0 0.2rem rgba(191, 0, 255, 0.15);
        }

        .btn-login {
            background: linear-gradient(135deg, #BF00FF 0%, #8b00c7 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(191, 0, 255, 0.4);
            color: white;
        }

        .back-link {
            text-align: center;
            margin-top: 25px;
        }

        .back-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #764ba2;
        }

        .info-text {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 12px;
            text-align: center;
            margin-top: 20px;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }

        @media (max-width: 991px) {
            .left-section {
                padding: 50px 40px;
            }

            .right-section {
                padding: 50px 40px;
            }

            .welcome-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 576px) {
            .left-section, .right-section {
                padding: 40px 30px;
            }

            .welcome-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="login-container">
        <div class="login-card">
            <div class="row g-0">
                <!-- Left Side - Info Section -->
                <div class="col-lg-6 left-section">
                    <div class="left-content">
                        <div class="brand-logo">
                            <i class="bi bi-book-fill"></i>
                            <span>bukutoko</span>
                        </div>
                        
                        <div class="icon-wrapper">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        
                        <h2 class="welcome-title">Admin Dashboard</h2>
                        <p class="welcome-text">
                            Kelola toko buku online dengan mudah. Atur produk, kategori, pesanan, dan pantau performa bisnis Anda.
                        </p>
                        
                        <div class="features-list">
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Kelola Kategori & Produk</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Konfirmasi Pembayaran</span>
                            </div>
                            <div class="feature-item">
                                <i class="bi bi-check-circle-fill"></i>
                                <span>Laporan & Statistik</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Login Form -->
                <div class="col-lg-6 right-section">
                    <div class="form-content">
                        <h2 class="login-title">Admin Login</h2>
                        <p class="login-subtitle">Masuk ke Dashboard Admin</p>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope-fill me-2"></i>Email Address
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}" 
                                       placeholder="admin@bukukita.com"
                                       required 
                                       autofocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="bi bi-lock-fill me-2"></i>Password
                                </label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password"
                                       placeholder="••••••••"
                                       required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-login">
                                <i class="bi bi-box-arrow-in-right me-2"></i>Login to Dashboard
                            </button>
                        </form>

                        <div class="back-link">
                            <a href="{{ route('home') }}">
                                <i class="bi bi-arrow-left me-2"></i>Kembali ke Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
