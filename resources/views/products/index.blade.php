@extends('layouts.app')

@section('title', 'Manajemen Produk')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-box"></i> Manajemen Produk</h1>
            <p>Kelola semua produk Anda</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ ($products->currentPage() - 1) * $products->perPage() + $key + 1 }}</td>
                                    <td>
                                        @if ($product->photo)
                                            <img src="{{ asset('storage/' . $product->photo) }}"
                                                alt="{{ $product->name }}" class="rounded"
                                                style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <span class="badge bg-secondary">Tidak ada foto</span>
                                        @endif
                                    </td>
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
                                        <small class="text-muted">{{ $product->created_at->format('d M Y') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav>
                    {{ $products->links('pagination::bootstrap-5') }}
                </nav>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">Belum ada produk. Mulai dengan membuat produk baru.</p>
                    <a href="{{ route('products.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Buat Produk Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
