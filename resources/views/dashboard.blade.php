@extends('layouts.app')

@section('title', 'Dashboard Insight')

@section('content')
<div class="page-header mb-4">
    <h1>Dashboard Storely</h1>
</div>

<!-- ================= LOGIKA REKOMENDASI OTOMATIS (2 REKOMENDASI MANAJEMEN) ================= -->
<div class="alert alert-info mb-4 shadow-sm" role="alert">
    <h5 class="fw-bold mb-3">💡 Rekomendasi Keputusan Bisnis (Management System):</h5>
    <ol class="mb-0 px-3">
        <!-- Rekomendasi 1: Pengadaan Barang Berdasarkan Stok Kritis -->
        <li class="mb-2">
            <strong>Rekomendasi Pengadaan (Stock In):</strong> 
            @if($totalCritical > 0)
                Sistem mendeteksi ada <strong>{{ $totalCritical }} produk</strong> yang stoknya kritis (di bawah 10 pcs). Pihak manajemen disarankan untuk segera melakukan proses *Stock In* hari ini demi menjaga ketersediaan barang dan menghindari hilangnya potensi penjualan.
            @else
                Semua stok produk saat ini berada dalam kondisi aman (di atas 10 pcs). Manajemen cukup memantau perputaran barang secara berkala tanpa perlu restock darurat.
            @endif
        </li>
        
        <!-- Rekomendasi 2: Analisis Varian Produk Berdasarkan Insight Penjualan -->
        <li>
            <strong>Rekomendasi Strategi Produk & Omzet (Sales Insight):</strong> 
            Saat ini terdapat <strong>{{ $totalProducts }} variasi produk</strong> terdaftar dengan total akumulasi <strong>{{ $totalItemsSold ?? 0 }} item</strong> yang berhasil terjual. Manajemen direkomendasikan untuk mengevaluasi produk yang perputarannya lambat (*slow-moving*) guna meminimalisir biaya penumpukan barang di gudang.
        </li>
    </ol>
</div>

<!-- ================= KOTAK INSIGHT DATA (CARDS) ================= -->
<div class="row mb-4">
    <!-- Total Produk -->
    <div class="col-md-3">
        <div class="card bg-primary text-white mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title opacity-75">Total Ragam Produk</h5>
                <h2 class="display-6 fw-bold">{{ $totalProducts }}</h2>
                <p class="card-text small">Produk terdaftar di sistem</p>
            </div>
        </div>
    </div>
    <!-- Item Terjual -->
    <div class="col-md-3">
        <div class="card bg-success text-white mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title opacity-75">Item Terjual (Sales)</h5>
                <h2 class="display-6 fw-bold">{{ $totalItemsSold ?? 0 }}</h2>
                <p class="card-text small">Dari {{ $totalSalesCount }} transaksi sukses</p>
            </div>
        </div>
    </div>
    <!-- Transaksi Stock In -->
    <div class="col-md-3">
        <div class="card bg-info text-white mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title opacity-75">Barang Masuk (Stock In)</h5>
                <h2 class="display-6 fw-bold">{{ $totalStockInCount }}</h2>
                <p class="card-text small">Riwayat transaksi restock</p>
            </div>
        </div>
    </div>
    <!-- Stok Kritis -->
    <div class="col-md-3">
        <div class="card bg-danger text-white mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title opacity-75">Stok Kritis</h5>
                <h2 class="display-6 fw-bold">{{ $totalCritical }}</h2>
                <p class="card-text small">Perlu tindakan restock segera</p>
            </div>
        </div>
    </div>
</div>

<!-- ================= TABEL PRODUK YANG HARUS DI-RESTOCK ================= -->
@if($totalCritical > 0)
<div class="card shadow-sm mb-4">
    <div class="card-header bg-dark text-white py-3">
        <h5 class="mb-0 fw-bold">Daftar Produk Perlu Pengadaan Segera</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-secondary">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Sisa Stok Saat Ini</th>
                        <th>Aksi Cepat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($criticalProducts as $product)
                        <tr>
                            <td class="fw-bold">{{ $product->name }}</td>
                            <td>
                                <span class="badge bg-danger fs-6">{{ $product->stock }} Pcs</span>
                            </td>
                            <td>
                                <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-warning fw-bold">
                                    + Tambah Stock In
                                  </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@endsection