@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('breadcrumb', 'Tambah Kategori')

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

    .form-card {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(139, 92, 246, 0.1);
    }

    .form-card-body {
        padding: 40px;
    }

    .form-label {
        font-weight: 700;
        color: #374151;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .form-control {
        border: 2px solid #E5E7EB;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #8B5CF6;
        box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.15);
    }

    .form-control.is-invalid {
        border-color: #DC2626;
    }

    .invalid-feedback {
        font-weight: 600;
        font-size: 0.85rem;
    }

    .btn-save {
        background: linear-gradient(135deg, #8B5CF6 0%, #7C3AED 100%);
        color: #ffffff;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(139, 92, 246, 0.4);
        color: #ffffff;
    }

    .btn-back {
        background: #F3F4F6;
        color: #6B7280;
        border: 2px solid #E5E7EB;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-back:hover {
        background: #E5E7EB;
        color: #374151;
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="page-title-wrapper">
        <div class="page-icon">
            <i class="bi bi-plus-circle-fill"></i>
        </div>
        <h1 class="page-title">Tambah Kategori Baru</h1>
    </div>
</div>

<div class="form-card">
    <div class="form-card-body">
        <form action="{{ route('admin.kategori.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nama" class="form-label">
                    <i class="bi bi-tag-fill me-2" style="color: #8B5CF6;"></i>Nama Kategori
                </label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" 
                       id="nama" name="nama" value="{{ old('nama') }}" 
                       placeholder="Masukkan nama kategori..." required>
                @error('nama')
                    <div class="invalid-feedback">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex gap-3 mt-4">
                <button type="submit" class="btn-save">
                    <i class="bi bi-check-circle me-2"></i> Simpan Kategori
                </button>
                <a href="{{ route('admin.kategori.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
