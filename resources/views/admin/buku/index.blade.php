@extends('layouts.admin')

@section('title', 'Kelola Buku')
@section('breadcrumb', 'Buku')

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

    .btn-add {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        border: none;
        color: #ffffff;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
        text-decoration: none;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        color: #ffffff;
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
        padding: 18px 16px;
        border: none !important;
        background: transparent !important;
    }

    .modern-table tbody td {
        padding: 16px;
        vertical-align: middle;
        border-bottom: 1px solid #F3F4F6;
        color: #4B5563;
        font-size: 0.9rem;
    }

    .modern-table tbody tr {
        transition: all 0.3s ease;
    }

    .modern-table tbody tr:hover {
        background: rgba(139, 92, 246, 0.03);
    }

    .book-cover {
        width: 60px;
        height: 85px;
        border-radius: 8px;
        object-fit: cover;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .book-cover-placeholder {
        width: 60px;
        height: 85px;
        background: linear-gradient(135deg, #E5E7EB 0%, #D1D5DB 100%);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #9CA3AF;
        font-size: 1.5rem;
    }

    .category-badge {
        background: rgba(139, 92, 246, 0.1);
        color: #7C3AED;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }

    .stock-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-block;
    }

    .stock-badge.low {
        background: rgba(239, 68, 68, 0.1);
        color: #DC2626;
    }

    .stock-badge.medium {
        background: rgba(245, 158, 11, 0.1);
        color: #D97706;
    }

    .stock-badge.high {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
    }

    .btn-view {
        background: linear-gradient(135deg, #3B82F6 0%, #2563EB 100%);
        border: none;
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(59, 130, 246, 0.4);
        color: #ffffff;
    }

    .btn-edit {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        border: none;
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(245, 158, 11, 0.4);
        color: #ffffff;
    }

    .btn-delete {
        background: linear-gradient(135deg, #EF4444 0%, #DC2626 100%);
        border: none;
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(239, 68, 68, 0.4);
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
            <i class="bi bi-book-fill"></i>
        </div>
        <h1 class="page-title">Kelola Buku</h1>
    </div>
    <a href="{{ route('admin.buku.create') }}" class="btn-add">
        <i class="bi bi-plus-circle-fill"></i>
        <span>Tambah Buku</span>
    </a>
</div>

<div class="modern-table">
    <table class="table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">Cover</th>
                <th>Judul Buku</th>
                <th width="12%">Kategori</th>
                <th width="15%">Penulis</th>
                <th width="12%">Harga</th>
                <th width="8%">Stok</th>
                <th width="18%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bukus as $index => $buku)
                <tr>
                    <td><strong>{{ $index + 1 }}</strong></td>
                    <td>
                        @if($buku->gambar && $buku->gambar !== 'default.jpg')
                            <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" class="book-cover">
                        @else
                            <div class="book-cover-placeholder">
                                <i class="bi bi-book"></i>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $buku->judul }}</strong></td>
                    <td>
                        <span class="category-badge">{{ $buku->kategori->nama ?? '-' }}</span>
                    </td>
                    <td>{{ $buku->penulis }}</td>
                    <td><strong>Rp {{ number_format($buku->harga, 0, ',', '.') }}</strong></td>
                    <td>
                        <span class="stock-badge {{ $buku->stok < 5 ? 'low' : ($buku->stok < 20 ? 'medium' : 'high') }}">
                            {{ $buku->stok }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.buku.show', $buku) }}" class="btn-view">
                            <i class="bi bi-eye-fill"></i>
                        </a>
                        <a href="{{ route('admin.buku.edit', $buku) }}" class="btn-edit">
                            <i class="bi bi-pencil-fill"></i>
                        </a>
                        <form action="{{ route('admin.buku.destroy', $buku) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <i class="bi bi-book-half"></i>
                            <p>Belum ada buku. Silakan tambahkan buku baru.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
