@extends('layouts.admin')

@section('title', 'Kelola Pesanan')
@section('breadcrumb', 'Pesanan')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(139, 92, 246, 0.1);
    }

    .page-title-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.3);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: #1a1a1a;
        margin: 0;
    }

    .modern-table {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(139, 92, 246, 0.1);
    }

    .modern-table thead {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
    }

    .modern-table thead th {
        color: #ffffff !important;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 18px 20px;
        border: none !important;
        background: transparent !important;
    }

    .modern-table tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        border-bottom: 1px solid #F3F4F6;
        color: #4B5563;
        font-size: 0.95rem;
    }

    .modern-table tbody tr {
        transition: all 0.3s ease;
    }

    .modern-table tbody tr:hover {
        background: rgba(139, 92, 246, 0.03);
    }

    .order-id-badge {
        font-family: 'Courier New', monospace;
        font-weight: 700;
        color: #7C3AED;
        background: rgba(139, 92, 246, 0.1);
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.9rem;
        display: inline-block;
    }

    .user-name {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #374151;
        font-weight: 500;
    }

    .user-name i {
        color: #8B5CF6;
    }

    .price-tag {
        font-weight: 700;
        color: #059669;
        font-size: 1rem;
    }

    .status-badge {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-badge.pending {
        background: rgba(107, 114, 128, 0.15);
        color: #6B7280;
        border: 1px solid rgba(107, 114, 128, 0.3);
    }

    .status-badge.menunggu_pembayaran {
        background: rgba(251, 191, 36, 0.15);
        color: #D97706;
        border: 1px solid rgba(251, 191, 36, 0.3);
    }

    .status-badge.tunggu_konfirmasi {
        background: rgba(59, 130, 246, 0.15);
        color: #2563EB;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .status-badge.dibayar {
        background: rgba(16, 185, 129, 0.15);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-badge.diproses {
        background: rgba(139, 92, 246, 0.15);
        color: #7C3AED;
        border: 1px solid rgba(139, 92, 246, 0.3);
    }

    .status-badge.dikirim {
        background: rgba(16, 185, 129, 0.15);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-badge.batal {
        background: rgba(239, 68, 68, 0.15);
        color: #DC2626;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .status-badge .pulse-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    .date-badge {
        display: flex;
        align-items: center;
        gap: 6px;
        color: #6B7280;
        font-size: 0.9rem;
    }

    .btn-view {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        color: #ffffff;
        border: none;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
        color: #ffffff;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #9CA3AF;
    }

    .empty-state i {
        font-size: 4rem;
        color: #E5E7EB;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="page-title-wrapper">
        <div class="page-icon">
            <i class="bi bi-cart-check-fill"></i>
        </div>
        <h1 class="page-title">Kelola Pesanan</h1>
    </div>
</div>

<div class="modern-table">
    <table class="table">
        <thead>
            <tr>
                <th width="6%">No</th>
                <th width="12%">ID</th>
                <th width="20%">User</th>
                <th width="15%">Total</th>
                <th width="17%">Status</th>
                <th width="16%">Tanggal</th>
                <th width="14%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pesanans as $index => $pesanan)
                <tr>
                    <td><strong>{{ $index + 1 }}</strong></td>
                    <td>
                        <span class="order-id-badge">#{{ $pesanan->id }}</span>
                    </td>
                    <td>
                        <div class="user-name">
                            <i class="bi bi-person-circle"></i>
                            {{ $pesanan->user->nama }}
                        </div>
                    </td>
                    <td>
                        <span class="price-tag">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </td>
                    <td>
                        @if($pesanan->status === 'pending')
                            <span class="status-badge pending">
                                <span class="pulse-dot"></span>
                                Pending
                            </span>
                        @elseif($pesanan->status === 'menunggu_pembayaran')
                            <span class="status-badge menunggu_pembayaran">
                                <span class="pulse-dot"></span>
                                Menunggu Bayar
                            </span>
                        @elseif($pesanan->status === 'tunggu_konfirmasi')
                            <span class="status-badge tunggu_konfirmasi">
                                <span class="pulse-dot"></span>
                                Tunggu Konfirmasi
                            </span>
                        @elseif($pesanan->status === 'dibayar')
                            <span class="status-badge dibayar">
                                <i class="bi bi-check-circle-fill"></i>
                                Dibayar
                            </span>
                        @elseif($pesanan->status === 'diproses')
                            <span class="status-badge diproses">
                                <span class="pulse-dot"></span>
                                Diproses
                            </span>
                        @elseif($pesanan->status === 'dikirim')
                            <span class="status-badge dikirim">
                                <i class="bi bi-check-circle-fill"></i>
                                Dikirim
                            </span>
                        @elseif($pesanan->status === 'batal')
                            <span class="status-badge batal">
                                <i class="bi bi-x-circle-fill"></i>
                                Batal
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="date-badge">
                            <i class="bi bi-calendar-check"></i>
                            {{ $pesanan->created_at->format('d M Y H:i') }}
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('admin.pesanan.show', $pesanan) }}" class="btn-view">
                            <i class="bi bi-eye-fill"></i>
                            Detail
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <i class="bi bi-cart-x"></i>
                            <p>Belum ada pesanan</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
