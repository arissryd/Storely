@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-header">
        <h1><i class="bi bi-speedometer2"></i> Dashboard</h1>
        <p>Selamat datang, <strong>{{ $userName }}</strong>! 👋</p>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-number">{{ $totalCategories }}</div>
                <div class="stat-label">
                    <i class="bi bi-tag"></i> Total Kategori
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="stat-card">
                <div class="stat-number">{{ $totalProducts }}</div>
                <div class="stat-label">
                    <i class="bi bi-box"></i> Total Produk
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('categories.create') }}" class="btn btn-primary me-2">
                <i class="bi bi-plus-circle"></i> Tambah Kategori
            </a>
            <a href="{{ route('products.create') }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Produk
            </a>
        </div>
    </div>

    <!-- Recent Products -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history"></i> Produk Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    @if ($recentProducts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recentProducts as $product)
                                        <tr>
                                            <td>
                                                <strong>{{ $product->name }}</strong>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $product->category->name }}</span>
                                            </td>
                                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                            <td>
                                                @if ($product->stock > 0)
                                                    <span class="badge bg-success">{{ $product->stock }}</span>
                                                @else
                                                    <span class="badge bg-danger">Habis</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">
                                                    {{ $product->created_at->format('d M Y') }}
                                                </small>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                            <p class="text-muted mt-3">Belum ada produk. Mulai dengan membuat kategori dan produk baru.</p>
                            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-plus-circle"></i> Buat Kategori Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Tips -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <i class="bi bi-lightbulb"></i>
                <strong>Tips:</strong>
                Mulai dengan membuat kategori produk terlebih dahulu, kemudian tambahkan produk ke dalam kategori.
                Setiap produk harus memiliki foto untuk ditampilkan di katalog.
            </div>
        </div>
    </div>
@endsection
