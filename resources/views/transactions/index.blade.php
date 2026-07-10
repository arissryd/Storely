@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')

<div class="page-header d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>Data Transaksi</h1>
    </div>

    <a href="{{ route('transactions.create') }}" class="btn btn-success shadow-sm">
        <i class="fas fa-plus-circle me-1"></i> Tambah Transaksi
    </a>
</div>

<div class="mb-3">
    <a href="{{ route('transactions.export.excel') }}" class="btn btn-success fw-bold me-2">
        📊 Export Excel
    </a>
    <a href="{{ route('transactions.export.pdf') }}" target="_blank" class="btn btn-danger fw-bold">
        📄 Cetak PDF
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Kode / No. Transaksi</th>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Qty</th>
            <th>Tipe Transaksi</th>
            <th>Merchant Code</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $transaction)
        <tr>
            <!-- Nomor Transaksi / Stock Code otomatis berdasarkan tipe -->
            <td>
                @if($transaction->type == 'sales')
                    <span class="badge bg-success">TRX-{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}</span>
                @else
                    <span class="badge bg-info">STK-{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}</span>
                @endif
            </td>
            
            <!-- Tanggal (Auto) -->
            <td>{{ $transaction->created_at->format('d-m-Y H:i') }}</td>
            
            <!-- Nama Produk -->
            <td class="fw-bold">{{ $transaction->product->name ?? 'Produk Dihapus' }}</td>
            
            <!-- Qty -->
            <td>{{ $transaction->qty }} Pcs</td>
            
            <!-- Tipe -->
            <td>{{ $transaction->type == 'sales' ? 'Penjualan' : 'Barang Masuk' }}</td>
            
            <!-- Merchant Code (Khusus Sales) -->
            <td>
    @if($transaction->type == 'sales')
        <span class="text-muted fw-bold">{{ $transaction->merchant_code }}</span>
    @else
        <span class="text-muted">-</span>
    @endif
</td>
        </tr>
        @endforeach
    </tbody>
</table>
        </div>
    </div>
</div>

@endsection