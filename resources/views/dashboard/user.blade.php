@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">

    <h1 class="text-2xl font-bold mb-6">
        Selamat Datang, {{ auth()->user()->name }}!
    </h1>

    <!-- STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Saldo</p>
            <p class="text-xl font-bold">Rp {{ number_format($saldo,0,',','.') }}</p>
            <a href="{{ route('withdrawals.user.create') }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Tarik Saldo</a>
        </div>

        <div class="card text-center mb-4">
            <div class="card-body">
                <p class="text-muted mb-1">Total Poin</p>

                <h1 class="fw-bold mb-3">
                    {{ $points }}
                    <span class="fs-6 text-muted">poin</span>
                </h1>

                <form action="{{ route('points.redeem') }}" method="POST">
                    @csrf
                    <button 
                        type="submit" 
                        class="btn btn-warning px-4"
                        {{ $points < 10 ? 'disabled' : '' }}
                    >
                        🎁 Redeem Poin
                    </button>
                </form>

                @if($points < 10)
                    <small class="text-muted d-block mt-2">
                        Minimal 10 poin untuk redeem
                    </small>
                @endif
            </div>
        </div>


        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Total Transaksi</p>
            <p class="text-xl font-bold">{{ $totalTransactions }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <p class="text-sm text-gray-500">Total Sampah</p>
            <p class="text-xl font-bold">{{ number_format($totalWaste,2) }} kg</p>
        </div>
    </div>

    <!-- CHART -->
    <div class="bg-white p-6 rounded shadow mb-8">
        <h2 class="text-lg font-semibold mb-4">
            Grafik Penyetoran Sampah (6 Bulan Terakhir)
        </h2>

        <canvas id="wasteChart" height="120"></canvas>
    </div>

    <!-- TRANSAKSI -->
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-lg font-semibold mb-4">Transaksi Terakhir</h2>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Berat (kg)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $t)
                <tr>
                    <td class="border p-2">{{ $t->created_at->format('d-m-Y') }}</td>
                    <td class="border p-2">{{ $t->wasteCategory->name ?? '-' }}</td>
                    <td class="border p-2">{{ $t->weight }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center p-4">Belum ada transaksi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('wasteChart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Total Sampah (kg)',
            data: @json($chartData),
            backgroundColor: '#16a34a'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endsection
