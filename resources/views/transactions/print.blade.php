<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Penjualan Storely</title>
    <style>
        body { font-family: sans-serif; color: #333; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>

    <div class="header">
        <h2>LAPORAN TRANSAKSI PENJUALAN (SALES)</h2>
        <p>Dicetak pada: {{ date('d-m-Y H:i:s') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nomor Transaksi</th>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Merchant Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>TRX-{{ str_pad($transaction->id, 4, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $transaction->created_at->format('d-m-Y') }}</td>
                <td><strong>{{ $transaction->product->name ?? 'Produk Dihapus' }}</strong></td>
                <td>{{ $transaction->qty }} Pcs</td>
                <td>{{ $transaction->merchant_code ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.print();
    </script>

</body>
</html>