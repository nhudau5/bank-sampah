@extends('layouts.app')

@section('content')
<div class="p-6 max-w-lg">
    <h1 class="text-xl font-bold mb-4">Tambah Transaksi</h1>

    <form action="{{ route('user.transactions.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label>Kategori Sampah</label>
            <select name="category_id" class="w-full border p-2" required>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">
                        {{ $cat->name }} (Rp {{ number_format($cat->price_per_kg) }}/kg)
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label>Berat (kg)</label>
            <input type="number" step="0.1" name="weight" class="w-full border p-2" required>
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Simpan
        </button>
    </form>
</div>
@endsection
