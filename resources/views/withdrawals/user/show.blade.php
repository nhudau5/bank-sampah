@extends('layouts.app')

@section('title', 'Detail Penarikan')

@section('content')
<div class="max-w-xl mx-auto bg-white shadow rounded-lg p-6">

    <h1 class="text-2xl font-bold mb-4">
        Detail Penarikan Saldo
    </h1>

    <div class="space-y-3 text-sm">
        <div>
            <span class="text-gray-500">Tanggal</span><br>
            <span class="font-medium">
                {{ $withdrawal->created_at->format('d M Y') }}
            </span>
        </div>

        <div>
            <span class="text-gray-500">Jumlah</span><br>
            <span class="font-semibold text-green-600">
                Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
            </span>
        </div>

        <div>
            <span class="text-gray-500">Status</span><br>
            @if($withdrawal->status === 'pending')
                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded">
                    Pending
                </span>
            @elseif($withdrawal->status === 'approved')
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded">
                    Approved
                </span>
            @else
                <span class="px-3 py-1 bg-red-100 text-red-700 rounded">
                    Rejected
                </span>
            @endif
        </div>

        @if($withdrawal->note)
        <div>
            <span class="text-gray-500">Catatan Admin</span><br>
            <span class="italic">{{ $withdrawal->note }}</span>
        </div>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('withdrawals.user.index') }}"
           class="text-sm text-green-600 hover:underline">
            ← Kembali ke riwayat
        </a>
    </div>

</div>
@endsection
