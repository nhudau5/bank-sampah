@extends('layouts.app')

@section('title', 'Laporan Admin')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Laporan Transaksi Admin</h1>
        <a href="{{ route('reports.admin', ['download' => 'pdf']) }}" class="btn btn-primary">
            Download PDF
        </a>
    </div>

    <div class="mb-4 grid grid-cols-2 gap-4">
        <div class="bg-gray-100 p-4 rounded shadow">
            <strong>Total Transactions:</strong> {{ $totalTransactions }}
        </div>
        <div class="bg-gray-100 p-4 rounded shadow">
            <strong>Total Approved:</strong> Rp {{ number_format($totalApproved) }}
        </div>
        <div class="bg-gray-100 p-4 rounded shadow">
            <strong>Total Rejected:</strong> Rp {{ number_format($totalRejected) }}
        </div>
        <div class="bg-gray-100 p-4 rounded shadow">
            <strong>Total Pending:</strong> Rp {{ number_format($totalPending) }}
        </div>
        <div class="bg-gray-100 p-4 rounded shadow">
            <strong>Total Weight:</strong> {{ $totalWeight }} kg
        </div>
        <div class="bg-gray-100 p-4 rounded shadow">
            <strong>Total Points:</strong> {{ $totalPoints }}
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="px-4 py-2 border">Kode</th>
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">User</th>
                    <th class="px-4 py-2 border">Kategori</th>
                    <th class="px-4 py-2 border">Berat (kg)</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $trx)
                <tr>
                    <td class="px-4 py-2 border">{{ $trx->code }}</td>
                    <td class="px-4 py-2 border">{{ $trx->created_at->format('d/m/Y') }}</td>
                    <td class="px-4 py-2 border">{{ $trx->user->name ?? 'Unknown' }}</td>
                    <td class="px-4 py-2 border">{{ $trx->category->name ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ number_format($trx->weight,2) }}</td>
                    <td class="px-4 py-2 border">Rp {{ number_format($trx->total_price) }}</td>
                    <td class="px-4 py-2 border">{{ ucfirst($trx->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
