@extends('layouts.admin')

@section('title', 'Detail Buku')

@push('styles')
<style>
    .detail-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .book-header {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        border-radius: 20px;
        padding: 30px;
        color: white;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }
    
    .book-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    
    .book-id {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 8px;
    }
    
    .book-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 8px;
    }
    
    .book-author {
        font-size: 1rem;
        opacity: 0.95;
    }
    
    .section-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .section-title {
        font-weight: 700;
        color: #1F2937;
        font-size: 1rem;
        padding: 20px 24px;
        border-bottom: 1px solid #F3F4F6;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .section-title i {
        color: #8B5CF6;
    }
    
    .section-body {
        padding: 20px 24px;
    }
    
    .book-image {
        width: 100%;
        max-height: 400px;
        object-fit: contain;
        border-radius: 12px;
        background: #F9FAFB;
    }
    
    .book-image-placeholder {
        width: 100%;
        height: 400px;
        border-radius: 12px;
        background: linear-gradient(135deg, #E5E7EB 0%, #D1D5DB 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .book-image-placeholder i {
        font-size: 5rem;
        color: #9CA3AF;
    }
    
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    @media (max-width: 576px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }
    
    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .info-item.full-width {
        grid-column: 1 / -1;
    }
    
    .info-label {
        font-size: 0.8rem;
        color: #9CA3AF;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    
    .info-value {
        color: #1F2937;
        font-weight: 500;
    }
    
    .info-value.price {
        color: #8B5CF6;
        font-weight: 700;
        font-size: 1.2rem;
    }
    
    .stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .stock-available {
        background: #D1FAE5;
        color: #065F46;
    }
    
    .stock-low {
        background: #FEF3C7;
        color: #92400E;
    }
    
    .stock-empty {
        background: #FEE2E2;
        color: #991B1B;
    }
    
    .btn-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 24px;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        color: white;
    }
    
    .btn-warning:hover {
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
        color: white;
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
        color: white;
    }
    
    .btn-secondary:hover {
        box-shadow: 0 8px 20px rgba(107, 114, 128, 0.3);
        color: white;
    }
    
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #6B7280;
        font-weight: 600;
        text-decoration: none;
        padding: 12px 0;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        color: #8B5CF6;
    }
    
    .breadcrumb-item a {
        color: #8B5CF6;
        text-decoration: none;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="detail-container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.buku.index') }}">Daftar Buku</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
        
        <!-- Book Header -->
        <div class="book-header">
            <div class="book-id">
                <i class="bi bi-book me-1"></i> Buku #{{ $buku->id }}
            </div>
            <div class="book-title">
                {{ $buku->judul }}
            </div>
            <div class="book-author">
                {{ $buku->penulis }}
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-5">
                <!-- Book Image -->
                <div class="section-card">
                    <h6 class="section-title"><i class="bi bi-image"></i> Gambar Buku</h6>
                    <div class="section-body text-center">
                        @if($buku->gambar && $buku->gambar !== 'default.jpg')
                            <img src="{{ asset('storage/' . $buku->gambar) }}" class="book-image" alt="{{ $buku->judul }}">
                        @else
                            <div class="book-image-placeholder">
                                <i class="bi bi-book"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7">
                <!-- Book Information -->
                <div class="section-card">
                    <h6 class="section-title"><i class="bi bi-info-circle"></i> Informasi Buku</h6>
                    <div class="section-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">ISBN</span>
                                <span class="info-value">{{ $buku->isbn }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Kategori</span>
                                <span class="info-value">{{ $buku->kategori->nama ?? '-' }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Penerbit</span>
                                <span class="info-value">{{ $buku->penerbit }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Tahun Terbit</span>
                                <span class="info-value">{{ $buku->tahun }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Harga</span>
                                <span class="info-value price">Rp {{ number_format($buku->harga, 0, ',', '.') }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Stok</span>
                                <span class="info-value">
                                    @if($buku->stok > 10)
                                        <span class="stock-badge stock-available">
                                            <i class="bi bi-check-circle"></i> {{ $buku->stok }} unit
                                        </span>
                                    @elseif($buku->stok > 0)
                                        <span class="stock-badge stock-low">
                                            <i class="bi bi-exclamation-triangle"></i> {{ $buku->stok }} unit
                                        </span>
                                    @else
                                        <span class="stock-badge stock-empty">
                                            <i class="bi bi-x-circle"></i> Habis
                                        </span>
                                    @endif
                                </span>
                            </div>
                            @if($buku->deskripsi)
                            <div class="info-item full-width">
                                <span class="info-label">Deskripsi</span>
                                <span class="info-value">{{ $buku->deskripsi }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="section-card">
                    <div class="section-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <a href="{{ route('admin.buku.edit', $buku) }}" class="btn-action btn-warning w-100">
                                    <i class="bi bi-pencil"></i> Edit Buku
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ route('admin.buku.index') }}" class="btn-action btn-secondary w-100">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Back Link -->
        <a href="{{ route('admin.buku.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Buku
        </a>
    </div>
</div>
@endsection
