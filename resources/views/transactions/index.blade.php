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

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-secondary">
                    <tr>
                        <th class="text-center" style="width: 7%">No</th>
                        <th>No / Kode Transaksi</th>
                        <th class="text-center">Tipe</th>
                        <th>Produk</th>
                        <th class="text-center">Qty</th>
                        <th>Merchant Code</th>
                        <th>Tanggal Transaksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($transactions as $key => $transaction)
                    <tr>
                        <td class="text-center text-muted font-weight-bold">{{ $key + 1 }}</td>
                        <td>
                            <span class="text-dark font-weight-bold">{{ $transaction->transaction_number }}</span>
                        </td>
                        <td class="text-center">
                            @if($transaction->type == 'sales')
                                <span class="badge bg-success px-2 py-1">Sales</span>
                            @else
                                <span class="badge bg-primary px-2 py-1">Stock In</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-dark font-weight-bold">{{ $transaction->product->name }}</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-light text-dark border px-2 py-1">{{ $transaction->qty }}</span>
                        </td>
                        <td>
                            @if($transaction->merchant_code)
                                <span class="text-secondary font-monospace">{{ $transaction->merchant_code }}</span>
                            @else
                                <span class="text-muted-500">-</span>
                            @endif
                        </td>
                        <td class="text-secondary">
                            {{ $transaction->created_at->format('d M Y, H:i') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            Belum ada data transaksi yang tercatat.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection