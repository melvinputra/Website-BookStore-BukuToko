@extends('layouts.admin')

@section('title', 'Edit Buku')
@section('breadcrumb', 'Edit Buku')

@push('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(251, 146, 60, 0.1);
    }

    .page-title-wrapper {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #FB923C 0%, #F97316 100%);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(251, 146, 60, 0.3);
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
        border: 1px solid rgba(251, 146, 60, 0.1);
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
        border-color: #FB923C;
        box-shadow: 0 0 0 0.2rem rgba(251, 146, 60, 0.15);
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #DC2626;
    }

    .invalid-feedback {
        font-weight: 600;
        font-size: 0.85rem;
    }

    .btn-update {
        background: linear-gradient(135deg, #FB923C 0%, #F97316 100%);
        color: #ffffff;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(251, 146, 60, 0.3);
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(251, 146, 60, 0.4);
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

    .current-image-preview {
        margin-top: 12px;
        padding: 16px;
        background: #F9FAFB;
        border-radius: 12px;
        border: 2px dashed #E5E7EB;
    }

    .current-image-preview img {
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="page-title-wrapper">
        <div class="page-icon">
            <i class="bi bi-pencil-square"></i>
        </div>
        <h1 class="page-title">Edit Buku</h1>
    </div>
</div>

<div class="form-card">
    <div class="form-card-body">
        <form action="{{ route('admin.buku.update', $buku) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="judul" class="form-label">
                        <i class="bi bi-book-fill text-warning me-2"></i>Judul Buku
                    </label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" 
                           id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" placeholder="Masukkan judul buku" required>
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="isbn" class="form-label">
                        <i class="bi bi-upc-scan text-warning me-2"></i>ISBN
                    </label>
                    <input type="text" class="form-control @error('isbn') is-invalid @enderror" 
                           id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn) }}" placeholder="Masukkan nomor ISBN" required>
                    @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="penulis" class="form-label">
                        <i class="bi bi-pen-fill text-warning me-2"></i>Penulis
                    </label>
                    <input type="text" class="form-control @error('penulis') is-invalid @enderror" 
                           id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" placeholder="Masukkan nama penulis" required>
                    @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-4">
                    <label for="penerbit" class="form-label">
                        <i class="bi bi-building text-warning me-2"></i>Penerbit
                    </label>
                    <input type="text" class="form-control @error('penerbit') is-invalid @enderror" 
                           id="penerbit" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" placeholder="Masukkan nama penerbit" required>
                    @error('penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-4">
                    <label for="kategori_id" class="form-label">
                        <i class="bi bi-tag-fill text-warning me-2"></i>Kategori
                    </label>
                    <select class="form-select @error('kategori_id') is-invalid @enderror" 
                            id="kategori_id" name="kategori_id">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id', $buku->kategori_id) == $kategori->id ? 'selected' : '' }}>
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
                        <i class="bi bi-calendar-event text-warning me-2"></i>Tahun Terbit
                    </label>
                    <input type="number" class="form-control @error('tahun') is-invalid @enderror" 
                           id="tahun" name="tahun" value="{{ old('tahun', $buku->tahun) }}" placeholder="2024" required>
                    @error('tahun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-4">
                    <label for="harga" class="form-label">
                        <i class="bi bi-cash-coin text-warning me-2"></i>Harga (Rp)
                    </label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" 
                           id="harga" name="harga" value="{{ old('harga', $buku->harga) }}" placeholder="50000" required>
                    @error('harga')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-4">
                    <label for="stok" class="form-label">
                        <i class="bi bi-box-seam text-warning me-2"></i>Stok
                    </label>
                    <input type="number" class="form-control @error('stok') is-invalid @enderror" 
                           id="stok" name="stok" value="{{ old('stok', $buku->stok) }}" placeholder="100" required>
                    @error('stok')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-8 mb-4">
                    <label for="gambar" class="form-label">
                        <i class="bi bi-image-fill text-warning me-2"></i>Gambar Cover
                    </label>
                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" 
                           id="gambar" name="gambar" accept="image/*">
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</small>
                    @error('gambar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if($buku->gambar && $buku->gambar !== 'default.jpg')
                        <div class="current-image-preview">
                            <small class="text-muted fw-bold d-block mb-2">Gambar saat ini:</small>
                            <img src="{{ asset('storage/' . $buku->gambar) }}" alt="{{ $buku->judul }}" style="width: 150px; height: auto;">
                        </div>
                    @endif
                </div>

                <div class="col-12 mb-4">
                    <label for="deskripsi" class="form-label">
                        <i class="bi bi-text-paragraph text-warning me-2"></i>Deskripsi
                    </label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" name="deskripsi" rows="5" placeholder="Masukkan deskripsi buku..." required>{{ old('deskripsi', $buku->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-3">
                <button type="submit" class="btn-update">
                    <i class="bi bi-check-circle"></i> Update Buku
                </button>
                <a href="{{ route('admin.buku.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
