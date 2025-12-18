@extends('layouts.app')

@section('title', 'Kategori Sampah')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Kategori Sampah</h1>

        <a href="{{ route('categories.create') }}"
           class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
            + Tambah Kategori
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($categories->count())
        <table class="w-full">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Nama</th>
                    <th class="p-3">Harga / Kg</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($categories as $category)
                <tr>
                    <td class="p-3">{{ $category->name }}</td>
                    <td class="p-3">
                        Rp {{ number_format($category->price_per_kg,0,',','.') }}
                    </td>
                    <td class="p-3 flex gap-2">
                        <a href="{{ route('categories.edit',$category) }}"
                           class="text-blue-600 hover:underline">Edit</a>

                        <form action="{{ route('categories.destroy',$category) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="p-4">
            {{ $categories->links() }}
        </div>
        @else
        <div class="p-10 text-center text-gray-500">
            Belum ada kategori.
        </div>
        @endif
    </div>
</div>
@endsection
