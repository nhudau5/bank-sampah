<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Bank Sampah</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2, h3 { margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #eee; }
        .summary p { margin: 2px 0; }
    </style>
</head>
<body>

<h2>Laporan Transaksi Bank Sampah</h2>
<p><strong>User:</strong> {{ $user->name }} ({{ $user->email }})</p>

<div class="summary">
    <p><strong>Saldo:</strong> Rp {{ number_format($saldo,0,',','.') }}</p>
    <p><strong>Total Poin:</strong> {{ $totalPoints }}</p>
    <p><strong>Total Transaksi:</strong> {{ $totalTransactions }}</p>
    <p><strong>Total Sampah:</strong> {{ number_format($totalWeight,2) }} kg</p>
    <p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalRevenue,0,',','.') }}</p>
</div>

<h3>Transaksi Terakhir</h3>

@if($recentTransactions->count() > 0)
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Kategori</th>
            <th>Berat (kg)</th>
            <th>Total (Rp)</th>
            <th>Poin</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recentTransactions as $t)
        <tr>
            <td>{{ $t->id }}</td>
            <td>{{ $t->category->name ?? '-' }}</td>
            <td>{{ $t->weight }}</td>
            <td>{{ number_format($t->total_price,0,',','.') }}</td>
            <td>{{ $t->points_earned }}</td>
            <td>{{ ucfirst($t->status) }}</td>
            <td>{{ $t->created_at->format('d-m-Y') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<p>Belum ada transaksi.</p>
@endif

<h3>Rekap Sampah 6 Bulan Terakhir</h3>

<table>
    <thead>
        <tr>
            <th>Bulan</th>
            <th>Total Sampah (kg)</th>
        </tr>
    </thead>
    <tbody>
        @forelse($monthlyWaste as $m)
        <tr>
            <td>{{ date('F', mktime(0,0,0,$m->month,1)) }}</td>
            <td>{{ number_format($m->total,2) }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="2">Tidak ada data</td>
        </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>
