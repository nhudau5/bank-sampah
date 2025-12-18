@extends('layouts.app')

@section('title', 'Penarikan Saldo')

@section('content')
<div class="max-w-5xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold">Penarikan Saldo</h1>
            <p class="text-gray-500 text-sm">
                Tarik saldo hasil setoran sampah kamu
            </p>
        </div>

        <!-- BUTTON TARIK SALDO (INI YANG KEMARIN HILANG) -->
        <a href="{{ route('withdrawals.user.create') }}"
           class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg font-medium shadow">
            <i class="fas fa-wallet mr-2"></i> Tarik Saldo
        </a>
    </div>

    <!-- INFO SALDO -->
    <div class="bg-white rounded-lg shadow p-5 mb-6 flex items-center justify-between">
        <div>
            <p class="text-sm text-gray-500">Saldo Kamu</p>
            <p class="text-2xl font-bold text-green-600">
                Rp {{ number_format(auth()->user()->saldo, 0, ',', '.') }}
            </p>
        </div>
        <i class="fas fa-money-bill-wave text-3xl text-green-500"></i>
    </div>

    <!-- TABEL -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Jumlah</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($withdrawals as $withdrawal)
                <tr class="border-t">
                    <td class="px-4 py-3">
                        {{ $withdrawal->created_at->format('d M Y') }}
                    </td>

                    <td class="px-4 py-3 font-semibold">
                        Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
                    </td>

                    <td class="px-4 py-3">
                        @if($withdrawal->status === 'pending')
                            <span class="px-3 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                                Pending
                            </span>
                        @elseif($withdrawal->status === 'approved')
                            <span class="px-3 py-1 text-xs rounded bg-green-100 text-green-700">
                                Approved
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded bg-red-100 text-red-700">
                                Rejected
                            </span>
                        @endif
                    </td>

                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('withdrawals.user.show', $withdrawal->id) }}"
                           class="text-green-600 hover:underline text-sm font-medium">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                        Belum ada penarikan saldo.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- PAGINATION -->
    <div class="mt-4">
        {{ $withdrawals->links() }}
    </div>

</div>
@endsection
