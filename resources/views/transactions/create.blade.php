@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')

<div class="page-header">
    <div>
        <h1>Tambah Transaksi Baru</h1>
    </div>
</div>

<div class="card">
    <div class="card-body">
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="type" class="form-label font-weight-bold">Jenis Transaksi</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="sales">Penjualan (Sales)</option>
                    <option value="stock_in">Barang Masuk (Stock In)</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="product_id" class="form-label font-weight-bold">Produk</label>
                <select name="product_id" id="product_id" class="form-control" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->stock }})</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="qty" class="form-label font-weight-bold">Jumlah (Qty)</label>
                <input type="number" name="qty" id="qty" min="1" class="form-control" placeholder="Masukkan jumlah barang" required>
            </div>

            <div class="form-group mb-4" id="merchant_code_wrapper">
                <label for="merchant_code" class="form-label font-weight-bold">Merchant Code</label>
                <input type="text" name="merchant_code" id="merchant_code" class="form-control" placeholder="Masukkan kode merchant" required>
            </div>

            <div class="d-flex justify-content-start">
                <button type="submit" class="btn btn-success me-2">
                    Simpan Transaksi
                </button>
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary">
                    Batal
                </a>
            </div>
            
        </form>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const merchantWrapper = document.getElementById('merchant_code_wrapper');
        const merchantInput = document.getElementById('merchant_code');

        typeSelect.addEventListener('change', function() {
            if (this.value === 'stock_in') {
                // Sembunyikan field merchant code dan hapus validasi wajibnya
                merchantWrapper.style.display = 'none';
                merchantInput.value = ''; 
                merchantInput.removeAttribute('required');
            } else {
                // Tampilkan kembali field merchant code dan set jadi wajib isi
                merchantWrapper.style.display = 'block';
                merchantInput.setAttribute('required', 'required');
            }
        });
    });
</script>

@endsection