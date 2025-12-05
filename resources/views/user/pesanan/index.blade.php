@extends('layouts.user')

@section('title', 'Riwayat Pesanan')

@push('styles')
<style>
    :root {
        --neon-purple: #BF00FF;
        --purple-dark: #9400d3;
    }

    .page-header {
        margin-bottom: 40px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(191, 0, 255, 0.1);
    }

    .page-title-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(191, 0, 255, 0.3);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a1a;
        margin: 0;
    }

    .order-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid rgba(191, 0, 255, 0.1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }

    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(191, 0, 255, 0.2);
        border-color: rgba(191, 0, 255, 0.3);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(191, 0, 255, 0.1);
    }

    .order-id {
        font-family: 'Courier New', monospace;
        font-weight: 800;
        font-size: 1.3rem;
        color: var(--neon-purple);
    }

    .order-date {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #6c757d;
        font-size: 0.9rem;
        margin-top: 5px;
    }

    .order-price {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--neon-purple);
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 8px;
    }

    .status-badge.pending {
        background: #6B7280;
        color: #ffffff;
        border: 1px solid #6B7280;
        font-weight: 700;
    }

    .status-badge.menunggu_pembayaran {
        background: #F59E0B;
        color: #ffffff;
        border: 1px solid #F59E0B;
        font-weight: 700;
    }

    .status-badge.tunggu_konfirmasi {
        background: #3B82F6;
        color: #ffffff;
        border: 1px solid #3B82F6;
        font-weight: 700;
    }

    .status-badge.dibayar,
    .status-badge.dikirim {
        background: #10B981;
        color: #ffffff;
        border: 1px solid #10B981;
        font-weight: 700;
    }

    .status-badge.diproses {
        background: var(--neon-purple);
        color: #ffffff;
        border: 1px solid var(--neon-purple);
        font-weight: 700;
    }

    .status-badge.batal {
        background: #EF4444;
        color: #ffffff;
        border: 1px solid #EF4444;
        font-weight: 700;
    }

    .order-items {
        margin-bottom: 20px;
    }

    .item-pill {
        display: inline-block;
        background: rgba(191, 0, 255, 0.08);
        color: #4B5563;
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        margin-right: 8px;
        margin-bottom: 8px;
        border: 1px solid rgba(191, 0, 255, 0.2);
    }

    .item-more {
        color: #6c757d;
        font-size: 0.85rem;
        font-style: italic;
    }

    .btn-detail {
        background: linear-gradient(135deg, var(--neon-purple) 0%, var(--purple-dark) 100%);
        color: #ffffff;
        border: none;
        padding: 10px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(191, 0, 255, 0.3);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-detail:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(191, 0, 255, 0.4);
        color: #ffffff;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: rgba(191, 0, 255, 0.03);
        border-radius: 16px;
        border: 1.5px dashed rgba(191, 0, 255, 0.2);
    }

    .empty-state i {
        font-size: 5rem;
        color: rgba(191, 0, 255, 0.3);
        margin-bottom: 20px;
    }

    .empty-state h4 {
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 15px;
    }

    .empty-state a {
        color: var(--neon-purple);
        font-weight: 700;
        text-decoration: none;
    }

    .empty-state a:hover {
        text-decoration: underline;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <div class="page-title-wrapper">
            <div class="page-icon">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <h1 class="page-title">Riwayat Pesanan</h1>
        </div>
    </div>

    @if($pesanans->isEmpty())
        <div class="empty-state">
            <i class="bi bi-receipt"></i>
            <h4>Belum Ada Pesanan</h4>
            <p class="text-muted">Anda belum memiliki riwayat pesanan. Mulai belanja sekarang!</p>
            <a href="{{ route('user.buku.index') }}" class="btn-detail mt-3">
                <i class="bi bi-cart-plus"></i> Mulai Belanja
            </a>
        </div>
    @else
        @foreach($pesanans as $pesanan)
            <div class="order-card">
                <div class="order-header">
                    <div>
                        <div class="order-id">
                            <i class="bi bi-receipt-cutoff"></i> Pesanan #{{ $pesanan->id }}
                        </div>
                        <div class="order-date">
                            <i class="bi bi-calendar-check"></i>
                            {{ $pesanan->created_at->format('d M Y H:i') }}
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="order-price">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</div>
                        @if($pesanan->status === 'pending')
                            <span class="status-badge pending">
                                <i class="bi bi-clock"></i> Pending
                            </span>
                        @elseif($pesanan->status === 'menunggu_pembayaran')
                            <span class="status-badge menunggu_pembayaran">
                                <i class="bi bi-hourglass-split"></i> Menunggu Pembayaran
                            </span>
                        @elseif($pesanan->status === 'tunggu_konfirmasi')
                            <span class="status-badge tunggu_konfirmasi">
                                <i class="bi bi-shield-check"></i> Tunggu Konfirmasi
                            </span>
                        @elseif($pesanan->status === 'dibayar')
                            <span class="status-badge dibayar">
                                <i class="bi bi-check-circle-fill"></i> Dibayar
                            </span>
                        @elseif($pesanan->status === 'diproses')
                            <span class="status-badge diproses">
                                <i class="bi bi-gear-fill"></i> Diproses
                            </span>
                        @elseif($pesanan->status === 'dikirim')
                            <span class="status-badge dikirim">
                                <i class="bi bi-truck"></i> Dikirim
                            </span>
                        @elseif($pesanan->status === 'batal')
                            <span class="status-badge batal">
                                <i class="bi bi-x-circle-fill"></i> Batal
                            </span>
                        @endif
                    </div>
                </div>

                <div class="order-items">
                    <strong style="color: #4B5563; font-size: 0.9rem; display: block; margin-bottom: 10px;">
                        <i class="bi bi-box me-1"></i> Item Pesanan:
                    </strong>
                    @foreach($pesanan->detailPesanans->take(3) as $detail)
                        <span class="item-pill">
                            <i class="bi bi-book-fill me-1"></i>
                            {{ Str::limit($detail->buku->judul, 30) }} <strong>({{ $detail->jumlah }}x)</strong>
                        </span>
                    @endforeach
                    @if($pesanan->detailPesanans->count() > 3)
                        <span class="item-more">
                            dan {{ $pesanan->detailPesanans->count() - 3 }} item lainnya
                        </span>
                    @endif
                </div>

                <a href="{{ route('user.pesanan.show', $pesanan) }}" class="btn-detail">
                    <i class="bi bi-eye-fill"></i> Lihat Detail
                </a>
            </div>
        @endforeach
    @endif
</div>
@endsection
