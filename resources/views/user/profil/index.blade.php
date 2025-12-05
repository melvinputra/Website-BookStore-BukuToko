@extends('layouts.user')

@section('title', 'Profil Saya')

@push('styles')
<style>
    .profil-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .profil-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .profil-card-header {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        color: white;
        padding: 20px 24px;
    }
    
    .profil-card-header h5 {
        margin: 0;
        font-weight: 600;
    }
    
    .profil-card-body {
        padding: 24px;
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-control {
        border-radius: 10px;
        padding: 12px 16px;
        border: 2px solid #E5E7EB;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #8B5CF6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }
    
    .btn-save {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 32px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-save:hover {
        background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }
    
    .avatar-section {
        text-align: center;
        padding: 30px;
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(124, 58, 237, 0.05) 100%);
        border-bottom: 1px solid rgba(139, 92, 246, 0.1);
    }
    
    .avatar-circle {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }
    
    .avatar-circle i {
        font-size: 3.5rem;
        color: white;
    }
    
    .user-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1F2937;
        margin-bottom: 4px;
    }
    
    .user-email {
        color: #6B7280;
        font-size: 0.95rem;
    }
    
    .user-role {
        display: inline-block;
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        color: white;
        padding: 4px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-top: 10px;
    }
    
    .info-box {
        background: #F5F3FF;
        border-left: 4px solid #8B5CF6;
        padding: 16px;
        border-radius: 0 8px 8px 0;
        margin-bottom: 20px;
    }
    
    .info-box i {
        color: #8B5CF6;
    }
    
    .info-box p {
        margin: 0;
        color: #5B21B6;
        font-size: 0.9rem;
    }
    
    .breadcrumb-item a {
        color: #8B5CF6;
        text-decoration: none;
    }
</style>
@endpush

@section('content')
<div class="profil-container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profil</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            <i class="bi bi-person-circle me-2" style="color: #8B5CF6;"></i>
            Profil Saya
        </h2>
        <p class="text-muted mb-0">Kelola informasi profil dan keamanan akun Anda</p>
    </div>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <div class="row">
        <!-- Left Column - Avatar -->
        <div class="col-lg-4 mb-4">
            <div class="profil-card">
                <div class="avatar-section">
                    <div class="avatar-circle">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h4 class="user-name">{{ auth()->user()->nama }}</h4>
                    <p class="user-email">{{ auth()->user()->email }}</p>
                    <span class="user-role">{{ ucfirst(auth()->user()->role) }}</span>
                </div>
                <div class="profil-card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Bergabung sejak</span>
                        <span class="fw-semibold">{{ auth()->user()->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Total Pesanan</span>
                        <span class="fw-semibold">{{ auth()->user()->pesanans()->count() ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Column - Forms -->
        <div class="col-lg-8">
            <!-- Update Profile -->
            <div class="profil-card">
                <div class="profil-card-header">
                    <h5><i class="bi bi-person-gear me-2"></i>Informasi Profil</h5>
                </div>
                <div class="profil-card-body">
                    <form action="{{ route('user.profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                   value="{{ old('nama', auth()->user()->nama) }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', auth()->user()->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn-save">
                                <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Update Password -->
            <div class="profil-card">
                <div class="profil-card-header">
                    <h5><i class="bi bi-shield-lock me-2"></i>Ubah Password</h5>
                </div>
                <div class="profil-card-body">
                    <div class="info-box">
                        <p><i class="bi bi-info-circle me-2"></i>Pastikan menggunakan password yang kuat dan mudah diingat.</p>
                    </div>
                    
                    <form action="{{ route('user.profil.password') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Minimal 8 karakter</small>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        
                        <div class="text-end">
                            <button type="submit" class="btn-save">
                                <i class="bi bi-shield-check me-2"></i>Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
