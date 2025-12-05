@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('breadcrumb', 'Kategori')

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

    .modern-table table {
        margin-bottom: 0;
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
        transform: scale(1.01);
    }

    .modern-table tbody tr:last-child td {
        border-bottom: none;
    }

    .btn-edit {
        background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%);
        border: none;
        color: #ffffff;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
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
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
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

    .empty-state p {
        font-size: 1.1rem;
        margin: 0;
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="page-title-wrapper">
        <div class="page-icon">
            <i class="bi bi-folder-fill"></i>
        </div>
        <h1 class="page-title">Kelola Kategori</h1>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="btn-add">
        <i class="bi bi-plus-circle-fill"></i>
        <span>Tambah Kategori</span>
    </a>
</div>

<div class="modern-table">
    <table class="table">
        <thead>
            <tr>
                <th width="8%">No</th>
                <th>Nama Kategori</th>
                <th width="25%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoris as $index => $kategori)
                <tr>
                    <td><strong>{{ $index + 1 }}</strong></td>
                    <td><strong>{{ $kategori->nama }}</strong></td>
                    <td>
                        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn-edit">
                            <i class="bi bi-pencil-fill"></i>
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
                                <i class="bi bi-trash-fill"></i>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <div class="empty-state">
                            <i class="bi bi-folder-x"></i>
                            <p>Belum ada kategori. Silakan tambahkan kategori baru.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
