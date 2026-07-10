<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show dashboard
     */
    public function index()
    {
        // 1. Hitung total transaksi penjualan & jumlah item yang sudah terjual
        $totalSalesCount = Transaction::where('type', 'sales')->count();
        $totalItemsSold = Transaction::where('type', 'sales')->sum('qty');
        
        // 2. Hitung total transaksi barang masuk (Stock In)
        $totalStockInCount = Transaction::where('type', 'stock_in')->count();

        // 3. Cari produk yang stoknya kritis (misal: di bawah 10 pcs)
        $criticalProducts = Product::where('stock', '<', 10)->get();
        $totalCritical = $criticalProducts->count();

        // 4. Hitung total seluruh jenis produk yang terdaftar
        $totalProducts = Product::count();

        // Kirim semua data insight ke view dashboard
        return view('dashboard', compact(
            'totalSalesCount', 
            'totalItemsSold', 
            'totalStockInCount', 
            'criticalProducts', 
            'totalCritical',
            'totalProducts'
        ));
    }
}