@extends('layouts.user')

@section('title', 'Detail Pesanan')

@push('styles')
<style>
    .detail-container {
        max-width: 900px;
        margin: 0 auto;
    }
    
    .order-header {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        border-radius: 20px;
        padding: 30px;
        color: white;
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }
    
    .order-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    
    .order-id {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 8px;
    }
    
    .order-date {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 16px;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .status-menunggu { background: #FEF3C7; color: #92400E; }
    .status-tunggu { background: #DBEAFE; color: #1E40AF; }
    .status-dibayar { background: #D1FAE5; color: #065F46; }
    .status-diproses { background: #E0E7FF; color: #3730A3; }
    .status-dikirim { background: #CFFAFE; color: #0E7490; }
    .status-selesai { background: #D1FAE5; color: #065F46; }
    .status-batal { background: #FEE2E2; color: #991B1B; }
    
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
    
    /* Product Item */
    .product-item {
        display: flex;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid #F3F4F6;
    }
    
    .product-item:last-child {
        border-bottom: none;
    }
    
    .product-img {
        width: 70px;
        height: 90px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
        background: #F3F4F6;
    }
    
    .product-img-placeholder {
        width: 70px;
        height: 90px;
        border-radius: 10px;
        background: linear-gradient(135deg, #E5E7EB 0%, #D1D5DB 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .product-img-placeholder i {
        font-size: 1.5rem;
        color: #9CA3AF;
    }
    
    .product-info {
        flex: 1;
    }
    
    .product-title {
        font-weight: 600;
        color: #1F2937;
        margin-bottom: 4px;
    }
    
    .product-author {
        font-size: 0.85rem;
        color: #6B7280;
        margin-bottom: 8px;
    }
    
    .product-qty {
        font-size: 0.85rem;
        color: #9CA3AF;
    }
    
    .product-price {
        text-align: right;
        font-weight: 700;
        color: #8B5CF6;
        white-space: nowrap;
    }
    
    /* Total Section */
    .total-section {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.08) 0%, rgba(124, 58, 237, 0.04) 100%);
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .total-label {
        font-weight: 600;
        color: #6B7280;
    }
    
    .total-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #8B5CF6;
    }
    
    /* Info Grid */
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
    
    /* Alert Box */
    .alert-box {
        padding: 16px 20px;
        border-radius: 12px;
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 16px;
    }
    
    .alert-box i {
        font-size: 1.2rem;
        margin-top: 2px;
    }
    
    .alert-box.warning {
        background: #FEF3C7;
        color: #92400E;
    }
    
    .alert-box.info {
        background: #DBEAFE;
        color: #1E40AF;
    }
    
    .alert-box.success {
        background: #D1FAE5;
        color: #065F46;
    }
    
    /* Action Buttons */
    .btn-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 14px 24px;
        border-radius: 12px;
        font-weight: 600;
        border: none;
        width: 100%;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        color: white;
    }
    
    .btn-danger:hover {
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3);
        color: white;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
    }
    
    .btn-success:hover {
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
        color: white;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        color: white;
    }
    
    .btn-primary:hover {
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
        color: white;
    }
    
    /* Bank Info */
    .bank-info {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.1) 0%, rgba(124, 58, 237, 0.05) 100%);
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 16px;
    }
    
    .bank-info-title {
        font-weight: 700;
        color: #6B21A8;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }
    
    .bank-info-row {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #4B5563;
        font-size: 0.9rem;
        margin-bottom: 4px;
    }
    
    .bank-info-row i {
        color: #8B5CF6;
        width: 20px;
    }
    
    /* Upload Section */
    .upload-input {
        border: 2px dashed #E5E7EB;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .upload-input:hover {
        border-color: #8B5CF6;
        background: rgba(139, 92, 246, 0.02);
    }
    
    .upload-input input[type="file"] {
        display: none;
    }
    
    .upload-input label {
        cursor: pointer;
        display: block;
    }
    
    .upload-input i {
        font-size: 2rem;
        color: #9CA3AF;
        margin-bottom: 8px;
    }
    
    .upload-input p {
        color: #6B7280;
        margin: 0;
        font-size: 0.9rem;
    }
    
    /* Bukti Transfer Image */
    .bukti-img {
        width: 100%;
        max-height: 250px;
        object-fit: contain;
        border-radius: 12px;
        background: #F9FAFB;
    }
    
    .bukti-time {
        text-align: center;
        color: #9CA3AF;
        font-size: 0.8rem;
        margin-top: 12px;
    }
    
    /* Back Button */
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
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.pesanan.index') }}">Pesanan</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
        
        <!-- Order Header -->
        <div class="order-header">
            <div class="order-id">
                <i class="bi bi-receipt me-1"></i> Pesanan #{{ $pesanan->id }}
            </div>
            <div class="order-date">
                {{ $pesanan->created_at->format('d M Y, H:i') }}
            </div>
            @if($pesanan->status === 'menunggu_pembayaran')
                <span class="status-badge status-menunggu"><i class="bi bi-clock"></i> Menunggu Pembayaran</span>
            @elseif($pesanan->status === 'tunggu_konfirmasi')
                <span class="status-badge status-tunggu"><i class="bi bi-hourglass-split"></i> Tunggu Konfirmasi</span>
            @elseif($pesanan->status === 'dibayar')
                <span class="status-badge status-dibayar"><i class="bi bi-check-circle"></i> Pembayaran Dikonfirmasi</span>
            @elseif($pesanan->status === 'diproses')
                <span class="status-badge status-diproses"><i class="bi bi-box-seam"></i> Sedang Diproses</span>
            @elseif($pesanan->status === 'dikirim')
                <span class="status-badge status-dikirim"><i class="bi bi-truck"></i> Dalam Pengiriman</span>
            @elseif($pesanan->status === 'selesai')
                <span class="status-badge status-selesai"><i class="bi bi-check-circle-fill"></i> Selesai</span>
            @elseif($pesanan->status === 'batal')
                <span class="status-badge status-batal"><i class="bi bi-x-circle"></i> Dibatalkan</span>
            @endif
        </div>
        
        <div class="row">
            <div class="col-lg-8">
                <!-- Products -->
                <div class="section-card">
                    <h6 class="section-title"><i class="bi bi-bag"></i> Produk Dipesan</h6>
                    <div class="section-body" style="padding-top: 8px; padding-bottom: 8px;">
                        @foreach($pesanan->detailPesanans as $detail)
                            <div class="product-item">
                                @if($detail->buku->gambar && $detail->buku->gambar !== 'default.jpg')
                                    <img src="{{ asset('storage/' . $detail->buku->gambar) }}" class="product-img" alt="{{ $detail->buku->judul }}">
                                @else
                                    <div class="product-img-placeholder">
                                        <i class="bi bi-book"></i>
                                    </div>
                                @endif
                                <div class="product-info">
                                    <div class="product-title">{{ $detail->buku->judul }}</div>
                                    <div class="product-author">{{ $detail->buku->penulis }}</div>
                                    <div class="product-qty">{{ $detail->jumlah }} × Rp {{ number_format($detail->harga, 0, ',', '.') }}</div>
                                </div>
                                <div class="product-price">
                                    Rp {{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="total-section">
                        <span class="total-label">Total Pembayaran</span>
                        <span class="total-value">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <!-- Shipping Info -->
                @if($pesanan->nama_penerima)
                <div class="section-card">
                    <h6 class="section-title"><i class="bi bi-geo-alt"></i> Alamat Pengiriman</h6>
                    <div class="section-body">
                        <div class="info-grid">
                            <div class="info-item">
                                <span class="info-label">Penerima</span>
                                <span class="info-value">{{ $pesanan->nama_penerima }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">No. Telepon</span>
                                <span class="info-value">{{ $pesanan->no_hp }}</span>
                            </div>
                            <div class="info-item full-width">
                                <span class="info-label">Alamat</span>
                                <span class="info-value">{{ $pesanan->alamat_pengiriman }}</span>
                            </div>
                            @if($pesanan->catatan)
                            <div class="info-item full-width">
                                <span class="info-label">Catatan</span>
                                <span class="info-value">{{ $pesanan->catatan }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <div class="col-lg-4">
                <!-- Status Alert -->
                @if($pesanan->status === 'menunggu_pembayaran')
                    <div class="alert-box warning">
                        <i class="bi bi-info-circle"></i>
                        <div>Silakan lakukan pembayaran dan upload bukti transfer.</div>
                    </div>
                @elseif($pesanan->status === 'tunggu_konfirmasi')
                    <div class="alert-box info">
                        <i class="bi bi-clock"></i>
                        <div>Bukti transfer sedang diverifikasi oleh admin.</div>
                    </div>
                @elseif($pesanan->status === 'dibayar')
                    <div class="alert-box success">
                        <i class="bi bi-check-circle"></i>
                        <div>Pembayaran dikonfirmasi! Pesanan akan segera diproses.</div>
                    </div>
                @elseif($pesanan->status === 'diproses')
                    <div class="alert-box info">
                        <i class="bi bi-box-seam"></i>
                        <div>Pesanan sedang dikemas dan akan segera dikirim.</div>
                    </div>
                @elseif($pesanan->status === 'dikirim')
                    <div class="alert-box info">
                        <i class="bi bi-truck"></i>
                        <div>Pesanan dalam perjalanan. Konfirmasi setelah diterima.</div>
                    </div>
                @elseif($pesanan->status === 'selesai')
                    <div class="alert-box success">
                        <i class="bi bi-check-circle"></i>
                        <div>Pesanan selesai! Terima kasih telah berbelanja.</div>
                    </div>
                @endif
                
                <!-- Payment Section -->
                @if($pesanan->status === 'menunggu_pembayaran' && !$pesanan->pembayaran)
                <div class="section-card">
                    <h6 class="section-title"><i class="bi bi-credit-card"></i> Pembayaran</h6>
                    <div class="section-body">
                        <div class="bank-info">
                            <div class="bank-info-title">Transfer ke:</div>
                            <div class="bank-info-row"><i class="bi bi-bank"></i> Bank BCA</div>
                            <div class="bank-info-row"><i class="bi bi-credit-card-2-front"></i> 1234567890</div>
                            <div class="bank-info-row"><i class="bi bi-person"></i> a.n. BukuKita</div>
                        </div>
                        
                        <form action="{{ route('user.pesanan.upload', $pesanan) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="upload-input mb-3" onclick="document.getElementById('bukti_transfer').click()">
                                <input type="file" id="bukti_transfer" name="bukti_transfer" accept="image/*" required onchange="updateFileName(this)">
                                <label>
                                    <i class="bi bi-cloud-arrow-up d-block"></i>
                                    <p id="file-name">Klik untuk upload bukti transfer</p>
                                </label>
                            </div>
                            <button type="submit" class="btn-action btn-primary">
                                <i class="bi bi-upload"></i> Upload Bukti
                            </button>
                        </form>
                    </div>
                </div>
                @endif
                
                <!-- Bukti Transfer -->
                @if($pesanan->pembayaran)
                <div class="section-card">
                    <h6 class="section-title"><i class="bi bi-image"></i> Bukti Transfer</h6>
                    <div class="section-body text-center">
                        <img src="{{ asset('storage/' . $pesanan->pembayaran->bukti_transfer) }}" class="bukti-img" alt="Bukti Transfer">
                        <div class="bukti-time">
                            <i class="bi bi-clock me-1"></i> {{ $pesanan->pembayaran->created_at->format('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Action: Cancel -->
                @if($pesanan->status === 'menunggu_pembayaran')
                <div class="section-card">
                    <div class="section-body">
                        <p class="text-muted mb-3" style="font-size: 0.85rem;">Belum transfer? Anda bisa membatalkan pesanan ini.</p>
                        <form action="{{ route('user.pesanan.batal', $pesanan) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-action btn-danger" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                <i class="bi bi-x-circle"></i> Batalkan Pesanan
                            </button>
                        </form>
                    </div>
                </div>
                @endif
                
                <!-- Action: Confirm Received -->
                @if($pesanan->status === 'dikirim')
                <div class="section-card">
                    <div class="section-body">
                        <p class="text-muted mb-3" style="font-size: 0.85rem;">Sudah menerima pesanan? Konfirmasi sekarang.</p>
                        <form action="{{ route('user.pesanan.selesai', $pesanan) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-action btn-success" onclick="return confirm('Konfirmasi pesanan telah diterima?')">
                                <i class="bi bi-check-circle"></i> Pesanan Diterima
                            </button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Back Link -->
        <a href="{{ route('user.pesanan.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function updateFileName(input) {
        const fileName = input.files[0] ? input.files[0].name : 'Klik untuk upload bukti transfer';
        document.getElementById('file-name').textContent = fileName;
    }
</script>
@endpush
