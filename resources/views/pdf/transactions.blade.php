<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transactions</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<h2>Laporan Transactions</h2>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Produk</th>
            <th>Alamat</th>
            <th>Metode</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transactions as $index => $transaction)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $transaction->customer->username ?? '-' }}</td>
            <td>{{ $transaction->product->nama ?? '-' }}</td>
            <td>{{ $transaction->alamat }}</td>
            <td>{{ $transaction->metode }}</td>
            <td>{{ $transaction->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
