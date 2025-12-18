@extends('layouts.app')

@section('title', 'My Transactions')

@section('content')
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">My Transactions</h1>
        <p class="text-gray-500 text-sm">Riwayat setor sampah kamu</p>
    </div>

    {{-- BUTTON TAMBAH TRANSAKSI (INI YANG HILANG SELAMA INI) --}}
    <a href="{{ route('user.transactions.create') }}"
       class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg
              hover:bg-green-700 transition">
        <i class="fas fa-plus mr-2"></i> Tambah Sampah
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-x-auto">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left">Tanggal</th>
                <th class="px-4 py-3 text-left">Kategori</th>
                <th class="px-4 py-3 text-left">Berat (kg)</th>
                <th class="px-4 py-3 text-left">Total</th>
                <th class="px-4 py-3 text-left">Status</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($transactions as $tx)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        {{ $tx->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $tx->category->name ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                        {{ number_format($tx->weight, 2) }}
                    </td>
                    <td class="px-4 py-3">
                        Rp {{ number_format($tx->total_price, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3">
                        @if($tx->status === 'approved')
                            <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                Approved
                            </span>
                        @elseif($tx->status === 'rejected')
                            <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">
                                Rejected
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                                Pending
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-6 text-center text-gray-500">
                        Belum ada transaksi. Yuk setor sampah pertama kamu ♻️
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $transactions->links() }}
</div>
@endsection
