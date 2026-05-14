@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="page-header">
        <h1><i class="bi bi-plus-circle"></i> Tambah Kategori Baru</h1>
        <p>Buat kategori baru untuk mengorganisir produk Anda</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-tag"></i> Nama Kategori
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}" 
                                placeholder="Contoh: Elektronik, Makanan, Pakaian" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="bi bi-file-text"></i> Deskripsi (Opsional)
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                id="description" name="description" rows="4"
                                placeholder="Jelaskan kategori ini..."
                                maxlength="500">{{ old('description') }}</textarea>
                            <small class="text-muted d-block mt-2">
                                <span id="charCount">0</span>/500 karakter
                            </small>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Simpan Kategori
                            </button>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="bi bi-info-circle"></i> Tips
                    </h5>
                    <ul class="small text-muted">
                        <li>Gunakan nama kategori yang jelas dan deskriptif</li>
                        <li>Hindari nama kategori yang terlalu panjang</li>
                        <li>Gunakan bahasa yang mudah dipahami pelanggan</li>
                        <li>Deskripsi membantu menjelaskan jenis produk dalam kategori</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('description').addEventListener('input', function() {
            document.getElementById('charCount').textContent = this.value.length;
        });
    </script>
@endsection
