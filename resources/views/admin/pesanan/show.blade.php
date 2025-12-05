@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@push('styles')
<style>
    .detail-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .detail-card-header {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        color: white;
        padding: 18px 24px;
    }
    
    .detail-card-header h5 {
        margin: 0;
        font-weight: 600;
        font-size: 1rem;
    }
    
    .detail-card-body {
        padding: 24px;
    }
    
    .info-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #F3F4F6;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #6B7280;
        width: 130px;
        flex-shrink: 0;
    }
    
    .info-value {
        color: #1F2937;
        flex: 1;
    }
    
    .product-table th {
        background: rgba(139, 92, 246, 0.1) !important;
        color: #6B21A8 !important;
        font-weight: 600;
        border: none;
        padding: 14px 16px;
    }
    
    .product-table td {
        padding: 14px 16px;
        border-bottom: 1px solid #F3F4F6;
        color: #374151;
    }
    
    .total-row td {
        font-weight: 700;
        background: rgba(139, 92, 246, 0.05);
        color: #6B21A8 !important;
    }
    
    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    
    .status-tunggu { background: #DBEAFE; color: #1E40AF; }
    .status-dibayar { background: #D1FAE5; color: #065F46; }
    .status-menunggu { background: #FEF3C7; color: #92400E; }
    .status-diproses { background: #E0E7FF; color: #3730A3; }
    .status-dikirim { background: #CFFAFE; color: #0E7490; }
    .status-selesai { background: #D1FAE5; color: #065F46; }
    .status-batal { background: #FEE2E2; color: #991B1B; }
    
    .btn-confirm {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }
    
    .btn-confirm:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
        transform: translateY(-2px);
    }
    
    .btn-back {
        background: white;
        color: #6B7280;
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-back:hover {
        background: #F9FAFB;
        color: #374151;
    }
    
    .btn-action {
        border: none;
        border-radius: 12px;
        padding: 12px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-action:hover {
        transform: translateY(-2px);
    }
    
    .btn-proses {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        color: white;
    }
    
    .btn-proses:hover {
        background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
        color: white;
    }
    
    .btn-kirim {
        background: linear-gradient(135deg, #0EA5E9 0%, #0284C7 100%);
        color: white;
    }
    
    .btn-kirim:hover {
        background: linear-gradient(135deg, #0284C7 0%, #0369A1 100%);
        color: white;
    }
    
    .btn-selesai {
        background: linear-gradient(135deg, #10B981 0%, #059669 100%);
        color: white;
    }
    
    .btn-selesai:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        color: white;
    }
    
    .btn-batal {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        color: white;
    }
    
    .btn-batal:hover {
        background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%);
        color: white;
    }
    
    .shipping-card {
        background: linear-gradient(135deg, rgba(139, 92, 246, 0.05) 0%, rgba(124, 58, 237, 0.02) 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 12px;
        padding: 16px;
        margin-top: 16px;
    }
    
    .shipping-card h6 {
        color: #6B21A8;
        font-weight: 700;
        margin-bottom: 12px;
    }
</style>
@endpush

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">
        <i class="bi bi-eye me-2" style="color: #8B5CF6;"></i>
        Detail Pesanan #{{ $pesanan->id }}
    </h2>
    <p class="text-muted mb-0">Dibuat pada {{ $pesanan->created_at->format('d M Y, H:i') }}</p>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Detail Barang -->
        <div class="detail-card">
            <div class="detail-card-header">
                <h5><i class="bi bi-bag me-2"></i>Detail Barang</h5>
            </div>
            <div class="detail-card-body p-0">
                <table class="table product-table mb-0">
                    <thead>
                        <tr>
                            <th>Buku</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Harga</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pesanan->detailPesanans as $detail)
                            <tr>
                                <td>
                                    <strong>{{ $detail->buku->judul }}</strong><br>
                                    <small class="text-muted">{{ $detail->buku->penulis }}</small>
                                </td>
                                <td class="text-center">{{ $detail->jumlah }}</td>
                                <td class="text-end">Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                        <tr class="total-row">
                            <td colspan="3" class="text-end">Total Pembayaran:</td>
                            <td class="text-end">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Data Pengiriman -->
        @if($pesanan->nama_penerima)
        <div class="detail-card">
            <div class="detail-card-header">
                <h5><i class="bi bi-truck me-2"></i>Data Pengiriman</h5>
            </div>
            <div class="detail-card-body">
                <div class="info-row">
                    <span class="info-label"><i class="bi bi-person me-2"></i>Penerima</span>
                    <span class="info-value">{{ $pesanan->nama_penerima }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="bi bi-telephone me-2"></i>No. HP</span>
                    <span class="info-value">{{ $pesanan->no_hp }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="bi bi-geo-alt me-2"></i>Alamat</span>
                    <span class="info-value">{{ $pesanan->alamat_pengiriman }}</span>
                </div>
                @if($pesanan->catatan)
                <div class="info-row">
                    <span class="info-label"><i class="bi bi-chat-dots me-2"></i>Catatan</span>
                    <span class="info-value">{{ $pesanan->catatan }}</span>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <!-- Informasi Pesanan -->
        <div class="detail-card">
            <div class="detail-card-header">
                <h5><i class="bi bi-info-circle me-2"></i>Informasi Pesanan</h5>
            </div>
            <div class="detail-card-body">
                <div class="info-row">
                    <span class="info-label">Pembeli</span>
                    <span class="info-value">{{ $pesanan->user->nama ?? $pesanan->user->name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $pesanan->user->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value">
                        @if($pesanan->status === 'tunggu_konfirmasi')
                            <span class="status-badge status-tunggu">Tunggu Konfirmasi</span>
                        @elseif($pesanan->status === 'dibayar')
                            <span class="status-badge status-dibayar">Dibayar</span>
                        @elseif($pesanan->status === 'menunggu_pembayaran')
                            <span class="status-badge status-menunggu">Menunggu Pembayaran</span>
                        @elseif($pesanan->status === 'diproses')
                            <span class="status-badge status-diproses">Diproses</span>
                        @elseif($pesanan->status === 'dikirim')
                            <span class="status-badge status-dikirim">Dikirim</span>
                        @elseif($pesanan->status === 'selesai')
                            <span class="status-badge status-selesai">Selesai</span>
                        @elseif($pesanan->status === 'batal')
                            <span class="status-badge status-batal">Dibatalkan</span>
                        @else
                            <span class="status-badge" style="background: #E5E7EB; color: #374151;">{{ ucfirst($pesanan->status) }}</span>
                        @endif
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal</span>
                    <span class="info-value">{{ $pesanan->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Aksi Pesanan -->
        @if(!in_array($pesanan->status, ['selesai', 'batal']))
        <div class="detail-card">
            <div class="detail-card-header">
                <h5><i class="bi bi-gear me-2"></i>Aksi Pesanan</h5>
            </div>
            <div class="detail-card-body">
                @if($pesanan->status === 'dibayar')
                    <form action="{{ route('admin.pesanan.proses', $pesanan) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn-action btn-proses w-100" onclick="return confirm('Proses pesanan ini?')">
                            <i class="bi bi-box-seam me-2"></i>Proses Pesanan
                        </button>
                    </form>
                @endif

                @if($pesanan->status === 'diproses')
                    <form action="{{ route('admin.pesanan.kirim', $pesanan) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn-action btn-kirim w-100" onclick="return confirm('Kirim pesanan ini?')">
                            <i class="bi bi-truck me-2"></i>Kirim Pesanan
                        </button>
                    </form>
                @endif

                @if($pesanan->status === 'dikirim')
                    <form action="{{ route('admin.pesanan.selesai', $pesanan) }}" method="POST" class="mb-2">
                        @csrf
                        <button type="submit" class="btn-action btn-selesai w-100" onclick="return confirm('Selesaikan pesanan ini?')">
                            <i class="bi bi-check-circle me-2"></i>Selesaikan Pesanan
                        </button>
                    </form>
                @endif

                @if(in_array($pesanan->status, ['menunggu_pembayaran', 'tunggu_konfirmasi', 'dibayar']))
                    <form action="{{ route('admin.pesanan.batal', $pesanan) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-action btn-batal w-100" onclick="return confirm('Batalkan pesanan ini? Stok akan dikembalikan.')">
                            <i class="bi bi-x-circle me-2"></i>Batalkan Pesanan
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @endif

        @if($pesanan->pembayaran)
            <!-- Bukti Transfer -->
            <div class="detail-card">
                <div class="detail-card-header">
                    <h5><i class="bi bi-image me-2"></i>Bukti Transfer</h5>
                </div>
                <div class="detail-card-body text-center">
                    <img src="{{ asset('storage/' . $pesanan->pembayaran->bukti_transfer) }}" 
                         alt="Bukti Transfer" class="img-fluid" style="border-radius: 12px; max-height: 300px;">
                    <small class="text-muted d-block mt-3">
                        <i class="bi bi-clock me-1"></i>Diupload: {{ $pesanan->pembayaran->created_at->format('d M Y, H:i') }}
                    </small>
                    
                    @if($pesanan->status === 'tunggu_konfirmasi')
                        <form action="{{ route('admin.pesanan.konfirmasi', $pesanan) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn-confirm" onclick="return confirm('Konfirmasi pembayaran ini?')">
                                <i class="bi bi-check-circle me-2"></i>Konfirmasi Pembayaran
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<a href="{{ route('admin.pesanan.index') }}" class="btn btn-back mt-3">
    <i class="bi bi-arrow-left me-2"></i>Kembali
</a>
@endsection
