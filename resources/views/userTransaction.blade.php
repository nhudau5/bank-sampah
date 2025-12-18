<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan User</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        h3 { margin-bottom: 5px; }
        .saldo { margin-bottom: 20px; }
        .saldo p { font-size: 24px; font-weight: bold; color: #16a34a; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 6px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Laporan User: {{ $user->name ?? '-' }}</h2>

    {{-- Saldo --}}
    <div class="saldo">
        <h3>Saldo Anda</h3>
        <p>Rp {{ number_format($saldo ?? 0, 0, ',', '.') }}</p>
    </div>

    {{-- Ringkasan --}}
    <div class="summary">
        <p><strong>Total Weight:</strong> {{ number_format($totalWeight ?? 0, 2, ',', '.') }} kg</p>
        <p><strong>Total Revenue:</strong> Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
        <p><strong>Total Points:</strong> {{ $totalPoints ?? 0 }}</p>
    </div>

    {{-- Tabel transaksi --}}
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Weight (kg)</th>
                <th>Amount (Rp)</th>
                <th>Points</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->category->name ?? '-' }}</td>
                <td>{{ number_format($t->weight ?? 0, 2, ',', '.') }}</td>
                <td>{{ number_format($t->total_price ?? 0, 0, ',', '.') }}</td>
                <td>{{ $t->points_earned ?? 0 }}</td>
                <td>{{ $t->status ?? '-' }}</td>
                <td>{{ $t->created_at ? $t->created_at->format('d-m-Y') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7">Tidak ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
