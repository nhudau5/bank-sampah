<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Admin</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .summary {
            margin-bottom: 15px;
        }
        .summary div {
            margin-bottom: 4px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #444;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) { background-color: #fafafa; }
    </style>
</head>
<body>
    <h2>Laporan Transaksi Admin</h2>

    <div class="summary">
        <div><strong>Total Transactions:</strong> {{ $totalTransactions }}</div>
        <div><strong>Total Approved:</strong> Rp {{ number_format($totalApproved) }}</div>
        <div><strong>Total Rejected:</strong> Rp {{ number_format($totalRejected) }}</div>
        <div><strong>Total Pending:</strong> Rp {{ number_format($totalPending) }}</div>
        <div><strong>Total Weight:</strong> {{ $totalWeight }} kg</div>
        <div><strong>Total Points:</strong> {{ $totalPoints }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Tanggal</th>
                <th>User</th>
                <th>Kategori</th>
                <th>Berat (kg)</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td>{{ $trx->code }}</td>
                <td>{{ $trx->created_at->format('d/m/Y') }}</td>
                <td>{{ $trx->user->name ?? '-' }}</td>
                <td>{{ $trx->category->name ?? '-' }}</td>
                <td>{{ number_format($trx->weight, 2) }}</td>
                <td>Rp {{ number_format($trx->total_price) }}</td>
                <td>{{ ucfirst($trx->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
