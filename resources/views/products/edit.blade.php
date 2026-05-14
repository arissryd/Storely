@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
    <div class="page-header">
        <h1><i class="bi bi-pencil"></i> Edit Produk</h1>
        <p>Perbarui informasi produk {{ $product->name }}</p>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="bi bi-box"></i> Nama Produk
                            </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">
                                <i class="bi bi-tag"></i> Kategori
                            </label>
                            <select class="form-select @error('category_id') is-invalid @enderror"
                                id="category_id" name="category_id" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
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
                                id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">
                                        <i class="bi bi-currency-dollar"></i> Harga (Rp)
                                    </label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        id="price" name="price" value="{{ old('price', $product->price) }}"
                                        step="100" min="0" required>
                                    @error('price')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">
                                        <i class="bi bi-stack"></i> Stok
                                    </label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                        id="stock" name="stock" value="{{ old('stock', $product->stock) }}"
                                        min="0" required>
                                    @error('stock')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">
                                <i class="bi bi-image"></i> Foto Produk (Opsional)
                            </label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                id="photo" name="photo" accept="image/*">
                            <small class="text-muted d-block mt-2">
                                Format: JPG, PNG, GIF | Ukuran maksimal: 2MB
                            </small>
                            @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                            @if ($product->photo)
                                <div class="mt-3">
                                    <strong>Foto Saat Ini:</strong>
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $product->photo) }}"
                                            alt="{{ $product->name }}" class="img-thumbnail"
                                            style="max-width: 200px;">
                                    </div>
                                </div>
                            @endif

                            <div id="photoPreview" class="mt-3"></div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Perbarui Produk
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">
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
                            {{ $product->created_at->format('d M Y H:i') }}
                        </p>
                        <p>
                            <strong>Diperbarui:</strong><br>
                            {{ $product->updated_at->format('d M Y H:i') }}
                        </p>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('photo').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('photoPreview').innerHTML =
                        '<strong>Preview Foto Baru:</strong><br>' +
                        '<img src="' + e.target.result + '" class="img-thumbnail mt-2" style="max-width: 200px;">';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
