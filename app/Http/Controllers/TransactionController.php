<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransactionsExport;
use App\Models\Transaction;
use App\Models\Product; // Wajib import model Product
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Tampilkan halaman utama list transaksi
     */
    public function index()
    {
        // Mengambil transaksi urutan terbaru beserta data produknya (Eager Loading)
        $transactions = Transaction::with('product')->latest()->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Tampilkan form tambah transaksi baru
     */
    public function create()
    {
        // Ambil semua data produk dari database buat pilihan dropdown di form
        $products = Product::all();
        
        return view('transactions.create', compact('products'));
    }

    /**
     * Proses simpan data transaksi baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi inputan form
        $request->validate([
            'type' => 'required|in:sales,stock_in',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'merchant_code' => 'required_if:type,sales', 
            // Wajib diisi jika tipenya sales
        ]);

        // 2. Ambil data produk untuk manipulasi stok
        $product = Product::findOrFail($request->product_id);

        // 3. LOGIKA UTAMA: Update Stok Otomatis
if ($request->type === 'sales') {
    // Ganti $product->stok jadi $product->stock
    if ($product->stock < $request->qty) {
        return redirect()->back()->with('error', 'Stok tidak mencukupi! Stok saat ini: ' . $product->stock)->withInput();
    }
    
    // Ganti 'stok' jadi 'stock'
    $product->decrement('stock', $request->qty); 
} else {
    // Ganti 'stok' jadi 'stock'
    $product->increment('stock', $request->qty);
}
        // 4. Otomatis Pasang Nomor Transaksi / 
        $prefix = $request->type === 'sales' ? 'TRX-' : 'STK-';
        $transaction_number = $prefix . rand(1000000000, 9999999999);

        // 5. Simpan data transaksi ke database
        Transaction::create([
            'type' => $request->type,
            'transaction_number' => $transaction_number,
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'merchant_code' => $request->type === 'sales' ? $request->merchant_code : null,
            'type'               => $request->type, 
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaksi berhasil disimpan!');
    }

    public function exportExcel()
{
    $fileName = 'laporan_penjualan_' . date('Y-m-d') . '.xlsx';
    
    // Pake package: Jauh lebih pendek karena logic-nya udah pindah ke file TransactionsExport
    return Excel::download(new TransactionsExport, $fileName);
}

public function exportPdf()
{
    $fileName = 'laporan_penjualan_' . date('Y-m-d') . '.pdf';
    $transactions = Transaction::with('product')->where('type', 'sales')->get();
    
    // Pake package: Murni diproses backend jadi file PDF asli, bukan cetakan browser
    $pdf = Pdf::loadView('transactions.print', compact('transactions'));
    return $pdf->download($fileName);
}
}