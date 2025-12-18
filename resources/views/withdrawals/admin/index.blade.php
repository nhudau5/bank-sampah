@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-1">Withdrawal Requests</h1>
    <p class="text-gray-600 mb-6">Permintaan penarikan saldo dari user</p>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm">
                    <th class="py-3 px-6 text-left">Kode</th>
                    <th class="py-3 px-6">Tanggal</th>
                    <th class="py-3 px-6">User</th>
                    <th class="py-3 px-6">Jumlah</th>
                    <th class="py-3 px-6">Metode</th>
                    <th class="py-3 px-6">Status</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-600 text-sm">
                @foreach($withdrawals as $wd)
                <tr class="border-b hover:bg-gray-100">
                    <td class="py-3 px-6 font-medium">WD-{{ $wd->id }}</td>
                    <td class="py-3 px-6">{{ $wd->created_at->format('d/m/Y') }}</td>
                    <td class="py-3 px-6">{{ $wd->user->name }}</td>
                    <td class="py-3 px-6 font-semibold">
                        Rp {{ number_format($wd->amount, 0, ',', '.') }}
                    </td>
                    <td class="py-3 px-6">{{ $wd->method }}</td>

                    <td class="py-3 px-6">
                        @if($wd->status === 'approved')
                            <span class="bg-green-200 text-green-800 px-3 py-1 rounded-full text-xs">
                                Approved
                            </span>
                        @elseif($wd->status === 'rejected')
                            <span class="bg-red-200 text-red-800 px-3 py-1 rounded-full text-xs">
                                Rejected
                            </span>
                        @else
                            <span class="bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-xs">
                                Pending
                            </span>
                        @endif
                    </td>

                    <td class="py-3 px-6 text-center space-x-2">
                        <a href="{{ route('withdrawals.admin.show', $wd->id) }}"
                           class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                           Detail
                        </a>

                        @if($wd->status === 'pending')
                        <form action="{{ route('withdrawals.admin.approve', $wd->id) }}" method="POST" class="inline">
                            @csrf
                            <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('withdrawals.admin.reject', $wd->id) }}" method="POST" class="inline">
                            @csrf
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Reject
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
