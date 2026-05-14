@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-tag"></i> Manajemen Kategori</h1>
            <p>Kelola semua kategori produk Anda</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kategori
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if ($categories->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Slug</th>
                                <th>Tanggal Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $key + 1 }}</td>
                                    <td>
                                        <strong>{{ $category->name }}</strong>
                                    </td>
                                    <td>
                                        @if ($category->description)
                                            <small>{{ Str::limit($category->description, 50) }}</small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <code>{{ $category->slug }}</code>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $category->created_at->format('d M Y H:i') }}</small>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-warning" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus kategori ini?')">
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
                    {{ $categories->links('pagination::bootstrap-5') }}
                </nav>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">Belum ada kategori. Mulai dengan membuat kategori baru.</p>
                    <a href="{{ route('categories.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i> Buat Kategori Pertama
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
