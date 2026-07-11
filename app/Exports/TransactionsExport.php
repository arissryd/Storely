<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransactionsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * Ambil data transaksi khusus sales
    */
    public function collection()
    {
        return Transaction::with('product')->where('type', 'sales')->get();
    }

    /**
    * Membuat Baris Judul Kolom (Header) Excel
    */
    public function headings(): array
    {
        return ['Nomor Transaksi', 'Tanggal', 'Produk', 'Qty', 'Merchant Code'];
    }

    /**
    * Mengatur Format Data Tiap Baris (Sama persis dengan logic lama lu)
    */
    public function map($transaction): array
    {
        return [
            'TRX-' . str_pad($transaction->id, 4, '0', STR_PAD_LEFT), 
            $transaction->created_at->format('Y-m-d'), 
            $transaction->product->name ?? 'Produk Dihapus', 
            $transaction->qty, 
            $transaction->merchant_code
        ];
    }
}