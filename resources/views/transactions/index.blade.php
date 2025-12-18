@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-2">Daftar Transaksi</h1>
    <p class="text-gray-600 mb-6">Kelola seluruh transaksi nasabah</p>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-700 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Kode</th>
                    <th class="py-3 px-6 text-left">Tanggal</th>
                    <th class="py-3 px-6 text-left">User</th>
                    <th class="py-3 px-6 text-left">Kategori</th>
                    <th class="py-3 px-6 text-left">Berat (kg)</th>
                    <th class="py-3 px-6 text-left">Total</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($transactions as $trx)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left font-medium">{{ $trx->code }}</td>
                    <td class="py-3 px-6">{{ $trx->created_at->format('d/m/Y') }}</td>
                    <td class="py-3 px-6">{{ $trx->user->name }}</td>
                    <td class="py-3 px-6">{{ $trx->category->name }}</td>
                    <td class="py-3 px-6">{{ number_format($trx->weight, 2) }}</td>
                    <td class="py-3 px-6">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                    <td class="py-3 px-6">
                        @if($trx->status === 'approved')
                            <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs">Approved</span>
                        @elseif($trx->status === 'rejected')
                            <span class="bg-red-200 text-red-800 py-1 px-3 rounded-full text-xs">Rejected</span>
                        @else
                            <span class="bg-yellow-200 text-yellow-800 py-1 px-3 rounded-full text-xs">Pending</span>
                        @endif
                    </td>
                    <td class="py-3 px-6 text-center">
                        <!-- Button trigger modal -->
                        <button onclick="openModal('{{ $trx->id }}')" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">Detail</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
@foreach($transactions as $trx)
<div id="modal-{{ $trx->id }}" class="fixed inset-0 hidden items-center justify-center bg-black bg-opacity-50 z-50">
    <div class="bg-white rounded-lg w-11/12 md:w-1/2 p-6 relative">
        <h2 class="text-xl font-bold mb-4">Detail Transaksi {{ $trx->code }}</h2>
        <ul class="text-gray-700">
            <li><strong>User:</strong> {{ $trx->user->name }}</li>
            <li><strong>Kategori:</strong> {{ $trx->category->name }}</li>
            <li><strong>Berat:</strong> {{ number_format($trx->weight, 2) }} kg</li>
            <li><strong>Total:</strong> Rp {{ number_format($trx->total) }}</li>
            <li><strong>Status:</strong> {{ ucfirst($trx->status) }}</li>
            @if($trx->notes)
            <li><strong>Catatan:</strong> {{ $trx->notes }}</li>
            @endif
        </ul>
        <button onclick="closeModal('{{ $trx->id }}')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-900">&times;</button>
    </div>
</div>
@endforeach

<script>
function openModal(id) {
    document.getElementById('modal-' + id).classList.remove('hidden');
    document.getElementById('modal-' + id).classList.add('flex');
}

function closeModal(id) {
    document.getElementById('modal-' + id).classList.remove('flex');
    document.getElementById('modal-' + id).classList.add('hidden');
}
</script>
@endsection
