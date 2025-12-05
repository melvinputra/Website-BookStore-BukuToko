@extends('layouts.user')

@section('title', 'Checkout')

@push('styles')
<style>
    .checkout-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .checkout-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .checkout-card-header {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        color: white;
        padding: 20px 24px;
    }
    
    .checkout-card-header h5 {
        margin: 0;
        font-weight: 600;
    }
    
    .checkout-card-body {
        padding: 24px;
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-control, .form-control:focus {
        border-radius: 10px;
        padding: 12px 16px;
        border: 2px solid #E5E7EB;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #8B5CF6;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
    }
    
    .required-star {
        color: #EF4444;
    }
    
    /* Order Summary */
    .order-item {
        display: flex;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid #F3F4F6;
    }
    
    .order-item:last-child {
        border-bottom: none;
    }
    
    .order-item-img {
        width: 80px;
        height: 100px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
    }
    
    .order-item-info {
        flex: 1;
    }
    
    .order-item-title {
        font-weight: 600;
        color: #1F2937;
        margin-bottom: 4px;
    }
    
    .order-item-author {
        font-size: 0.875rem;
        color: #6B7280;
        margin-bottom: 8px;
    }
    
    .order-item-qty {
        font-size: 0.875rem;
        color: #6B7280;
    }
    
    .order-item-price {
        font-weight: 600;
        color: #8B5CF6;
        text-align: right;
        white-space: nowrap;
    }
    
    /* Summary Total */
    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #F3F4F6;
    }
    
    .summary-row:last-child {
        border-bottom: none;
    }
    
    .summary-row.total {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1F2937;
        padding-top: 16px;
        border-top: 2px solid #E5E7EB;
        margin-top: 8px;
    }
    
    .summary-row.total .price {
        color: #8B5CF6;
    }
    
    /* Buttons */
    .btn-checkout {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 16px 32px;
        font-weight: 600;
        font-size: 1rem;
        width: 100%;
        transition: all 0.3s ease;
    }
    
    .btn-checkout:hover {
        background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
    }
    
    .btn-back {
        background: white;
        color: #6B7280;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        padding: 14px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background: #F9FAFB;
        color: #374151;
        border-color: #D1D5DB;
    }
    
    /* Breadcrumb */
    .breadcrumb-item a {
        color: #8B5CF6;
        text-decoration: none;
    }
    
    .breadcrumb-item.active {
        color: #6B7280;
    }
    
    /* Info Box */
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
    
    /* Empty Image Placeholder */
    .img-placeholder {
        width: 80px;
        height: 100px;
        border-radius: 8px;
        background: linear-gradient(135deg, #E5E7EB 0%, #D1D5DB 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .img-placeholder i {
        font-size: 2rem;
        color: #9CA3AF;
    }
</style>
@endpush

@section('content')
<div class="checkout-container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
            @if($type === 'cart')
                <li class="breadcrumb-item"><a href="{{ route('user.keranjang.index') }}">Keranjang</a></li>
            @else
                <li class="breadcrumb-item"><a href="{{ route('user.buku.index') }}">Katalog</a></li>
            @endif
            <li class="breadcrumb-item active">Checkout</li>
        </ol>
    </nav>
    
    <!-- Page Title -->
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            <i class="bi bi-bag-check me-2" style="color: #8B5CF6;"></i>
            Checkout
        </h2>
        <p class="text-muted mb-0">Lengkapi data pengiriman untuk menyelesaikan pesanan</p>
    </div>
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    
    <form action="{{ $type === 'cart' ? route('user.pesanan.checkout') : route('user.pesanan.buynow') }}" method="POST">
        @csrf
        
        @if($type === 'buy_now')
            <input type="hidden" name="buku_id" value="{{ $buku->id }}">
            <input type="hidden" name="jumlah" value="{{ $jumlah }}">
        @endif
        
        <div class="row">
            <!-- Left Column - Shipping Form -->
            <div class="col-lg-7 mb-4">
                <div class="checkout-card">
                    <div class="checkout-card-header">
                        <h5><i class="bi bi-truck me-2"></i>Data Pengiriman</h5>
                    </div>
                    <div class="checkout-card-body">
                        <div class="info-box">
                            <p><i class="bi bi-info-circle me-2"></i>Pastikan data pengiriman sudah benar untuk menghindari kesalahan pengiriman.</p>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Nama Penerima <span class="required-star">*</span></label>
                            <input type="text" name="nama_penerima" class="form-control @error('nama_penerima') is-invalid @enderror" 
                                   placeholder="Masukkan nama lengkap penerima" value="{{ old('nama_penerima', auth()->user()->name) }}" required>
                            @error('nama_penerima')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Nomor HP / WhatsApp <span class="required-star">*</span></label>
                            <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                                   placeholder="Contoh: 081234567890" value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">Alamat Lengkap <span class="required-star">*</span></label>
                            <textarea name="alamat_pengiriman" rows="3" class="form-control @error('alamat_pengiriman') is-invalid @enderror" 
                                      placeholder="Masukkan alamat lengkap termasuk RT/RW, Kelurahan, Kecamatan, Kota, Kode Pos" required>{{ old('alamat_pengiriman') }}</textarea>
                            @error('alamat_pengiriman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-0">
                            <label class="form-label">Catatan <span class="text-muted">(Opsional)</span></label>
                            <textarea name="catatan" rows="2" class="form-control" 
                                      placeholder="Catatan tambahan untuk kurir, misalnya: Rumah warna biru, patokan depan warung">{{ old('catatan') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Order Summary -->
            <div class="col-lg-5">
                <div class="checkout-card">
                    <div class="checkout-card-header">
                        <h5><i class="bi bi-receipt me-2"></i>Ringkasan Pesanan</h5>
                    </div>
                    <div class="checkout-card-body">
                        <!-- Order Items -->
                        @if($type === 'cart')
                            @foreach($keranjangs as $item)
                                <div class="order-item">
                                    @if($item->buku->gambar && $item->buku->gambar !== 'default.jpg')
                                        <img src="{{ asset('storage/' . $item->buku->gambar) }}" alt="{{ $item->buku->judul }}" class="order-item-img">
                                    @else
                                        <div class="img-placeholder">
                                            <i class="bi bi-book"></i>
                                        </div>
                                    @endif
                                    <div class="order-item-info">
                                        <div class="order-item-title">{{ $item->buku->judul }}</div>
                                        <div class="order-item-author">{{ $item->buku->penulis }}</div>
                                        <div class="order-item-qty">{{ $item->jumlah }} x Rp {{ number_format($item->buku->harga, 0, ',', '.') }}</div>
                                    </div>
                                    <div class="order-item-price">
                                        Rp {{ number_format($item->buku->harga * $item->jumlah, 0, ',', '.') }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="order-item">
                                @if($buku->gambar && $buku->gambar !== 'default.jpg')
                                    <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="order-item-img">
                                @else
                                    <div class="img-placeholder">
                                        <i class="bi bi-book"></i>
                                    </div>
                                @endif
                                <div class="order-item-info">
                                    <div class="order-item-title">{{ $buku->judul }}</div>
                                    <div class="order-item-author">{{ $buku->penulis }}</div>
                                    <div class="order-item-qty">{{ $jumlah }} x Rp {{ number_format($buku->harga, 0, ',', '.') }}</div>
                                </div>
                                <div class="order-item-price">
                                    Rp {{ number_format($buku->harga * $jumlah, 0, ',', '.') }}
                                </div>
                            </div>
                        @endif
                        
                        <!-- Summary -->
                        <div class="mt-4">
                            <div class="summary-row">
                                <span class="text-muted">Subtotal</span>
                                <span>Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                            </div>
                            <div class="summary-row">
                                <span class="text-muted">Ongkos Kirim</span>
                                <span class="text-success">Gratis</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total Pembayaran</span>
                                <span class="price">Rp {{ number_format($totalHarga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        <!-- Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-checkout mb-3">
                                <i class="bi bi-check-circle me-2"></i>Buat Pesanan
                            </button>
                            
                            @if($type === 'cart')
                                <a href="{{ route('user.keranjang.index') }}" class="btn btn-back w-100">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Keranjang
                                </a>
                            @else
                                <a href="{{ route('user.buku.show', $buku) }}" class="btn btn-back w-100">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Detail Buku
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
