@extends('layouts.app')

@section('title', 'Transaction Details')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h1 class="text-2xl font-bold mb-6">Transaction #{{ $transaction->id }}</h1>

    <div class="mb-3">
        <span class="font-semibold">User:</span> {{ $transaction->user->name ?? 'N/A' }}
    </div>

    <div class="mb-3">
        <span class="font-semibold">Category / Type:</span> {{ $transaction->category->name ?? $transaction->type ?? 'N/A' }}
    </div>

    <div class="mb-3">
        <span class="font-semibold">Weight:</span> {{ $transaction->weight ?? '0' }} kg
    </div>

    <div class="mb-3">
        <span class="font-semibold">Amount:</span> Rp {{ number_format($transaction->amount ?? 0, 0, ',', '.') }}
    </div>

    <div class="mb-3">
        <span class="font-semibold">Status:</span>
        @if($transaction->status === 'pending')
            <span class="text-yellow-500 font-semibold">Pending</span>
        @elseif($transaction->status === 'approved')
            <span class="text-green-500 font-semibold">Approved</span>
        @elseif($transaction->status === 'rejected')
            <span class="text-red-500 font-semibold">Rejected</span>
        @else
            <span>{{ ucfirst($transaction->status) }}</span>
        @endif
    </div>

    <div class="mb-3">
        <span class="font-semibold">Created At:</span> {{ $transaction->created_at->format('d M Y H:i') }}
    </div>

    <div class="mb-3">
        <span class="font-semibold">Updated At:</span> {{ $transaction->updated_at->format('d M Y H:i') }}
    </div>

    <div class="mt-6 flex space-x-3">
        <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Back</a>

        @if(auth()->user()->isAdmin() && $transaction->status === 'pending')
            <form action="{{ route('transactions.approve', $transaction->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Approve</button>
            </form>
            <form action="{{ route('transactions.reject', $transaction->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Reject</button>
            </form>
        @endif
    </div>
</div>
@endsection
