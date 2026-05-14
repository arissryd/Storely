@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="page-header">
        <h1><i class="bi bi-pencil"></i> Edit Kategori</h1>
        <p>Perbarui informasi kategori {{ $category->name }}</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-tag"></i> Nama Kategori
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $category->name) }}" required>
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
                                maxlength="500">{{ old('description', $category->description) }}</textarea>
                            <small class="text-muted d-block mt-2">
                                <span id="charCount">{{ strlen(old('description', $category->description)) }}</span>/500 karakter
                            </small>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-link"></i> Slug
                            </label>
                            <input type="text" class="form-control" value="{{ $category->slug }}" disabled>
                            <small class="text-muted">Slug dibuat otomatis dari nama kategori</small>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Perbarui Kategori
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
                        <i class="bi bi-info-circle"></i> Informasi
                    </h5>
                    <small class="text-muted">
                        <p>
                            <strong>Dibuat:</strong><br>
                            {{ $category->created_at->format('d M Y H:i') }}
                        </p>
                        <p>
                            <strong>Diperbarui:</strong><br>
                            {{ $category->updated_at->format('d M Y H:i') }}
                        </p>
                    </small>
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
