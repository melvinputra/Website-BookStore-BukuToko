@extends('layouts.admin')

@section('title', 'Tambah Buku')
@section('breadcrumb', 'Tambah Buku')

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

    .form-control, .form-select {
        border: 2px solid #E5E7EB;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #8B5CF6;
        box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.15);
    }

    .form-control.is-invalid, .form-select.is-invalid {
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
        <h1 class="page-title">Tambah Buku Baru</h1>
    </div>
</div>

<div class="form-card">
    <div class="form-card-body">
        <form action="{{ route('admin.buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="judul" class="form-label">
                        <i class="bi bi-book-fill text-primary me-2"></i>Judul Buku
                    </label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                           id="judul" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul buku" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="isbn" class="form-label">
                        <i class="bi bi-upc-scan text-primary me-2"></i>ISBN
                    </label>
                    <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                           id="isbn" name="isbn" value="{{ old('isbn') }}" placeholder="Masukkan nomor ISBN" required>
                    @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="penulis" class="form-label">
                        <i class="bi bi-pen-fill text-primary me-2"></i>Penulis
                    </label>
                    <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                           id="penulis" name="penulis" value="{{ old('penulis') }}" placeholder="Masukkan nama penulis" required>
                    @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="penerbit" class="form-label">
                        <i class="bi bi-building text-primary me-2"></i>Penerbit
                    </label>
                    <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                           id="penerbit" name="penerbit" value="{{ old('penerbit') }}" placeholder="Masukkan nama penerbit" required>
                    @error('penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-4">
                    <label for="kategori_id" class="form-label">
                        <i class="bi bi-tag-fill text-primary me-2"></i>Kategori
                    </label>
                    <select class="form-select @error('kategori_id') is-invalid @enderror" 
                            id="kategori_id" name="kategori_id">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-4">
                    <label for="tahun" class="form-label">
                        <i class="bi bi-calendar-event text-primary me-2"></i>Tahun Terbit
                    </label>
                    <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                           id="tahun" name="tahun" value="{{ old('tahun') }}" placeholder="2024" required>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-4">
                    <label for="harga" class="form-label">
                        <i class="bi bi-cash-coin text-primary me-2"></i>Harga (Rp)
                    </label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                           id="harga" name="harga" value="{{ old('harga') }}" placeholder="50000" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-4">
                    <label for="stok" class="form-label">
                        <i class="bi bi-box-seam text-primary me-2"></i>Stok
                    </label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                           id="stok" name="stok" value="{{ old('stok') }}" placeholder="100" required>
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-8 mb-4">
                    <label for="gambar" class="form-label">
                        <i class="bi bi-image-fill text-primary me-2"></i>Gambar Cover
                    </label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                           id="gambar" name="gambar" accept="image/*" required>
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12 mb-4">
                    <label for="deskripsi" class="form-label">
                        <i class="bi bi-text-paragraph text-primary me-2"></i>Deskripsi
                    </label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="5" placeholder="Masukkan deskripsi buku..." required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn-save">
                    <i class="bi bi-save"></i> Simpan Buku
                </button>
                <a href="{{ route('admin.buku.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
