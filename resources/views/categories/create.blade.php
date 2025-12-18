@extends('layouts.app')

@section('title', 'Add New Waste Category')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6">Add New Waste Category</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block font-semibold mb-2">Category Name</label>
            <input type="text" id="name" name="name" placeholder="e.g. Plastic, Paper"
                class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400">
        </div>

        <div class="mb-4">
            <label for="description" class="block font-semibold mb-2">Description (optional)</label>
            <textarea id="description" name="description" placeholder="Describe this category"
                class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400"></textarea>
        </div>

        <div class="mb-4">
            <label for="price_per_kg" class="block font-semibold mb-2">Price per kg</label>
            <input type="number" id="price_per_kg" name="price_per_kg" placeholder="e.g. 5000"
                class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <div class="mb-4">
            <label for="points_per_kg" class="block font-semibold mb-2">Points per kg</label>
            <input type="number" id="points_per_kg" name="points_per_kg" placeholder="e.g. 5"
                class="w-full p-3 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-400" required>
        </div>

        <div class="flex justify-between mt-6">
            <a href="{{ route('categories.index') }}"
               class="btn"
               style="background: linear-gradient(135deg, #ff6ec4, #7873f5); color: white; font-weight: 600; padding: 0.75rem 1.5rem; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.2); transition: transform 0.2s, box-shadow 0.2s;">
                Cancel
            </a>

            <button type="submit"
                    class="btn"
                    style="background: linear-gradient(135deg, #42e695, #3bb2b8); color: white; font-weight: 600; padding: 0.75rem 1.5rem; border-radius: 0.5rem; box-shadow: 0 4px 6px rgba(0,0,0,0.2); transition: transform 0.2s, box-shadow 0.2s;">
                Save Category
            </button>
        </div>
    </form>
</div>

<script>
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
        btn.addEventListener('mouseover', () => {
            btn.style.transform = 'translateY(-2px)';
            btn.style.boxShadow = '0 6px 8px rgba(0,0,0,0.25)';
        });
        btn.addEventListener('mouseout', () => {
            btn.style.transform = 'translateY(0)';
            btn.style.boxShadow = '0 4px 6px rgba(0,0,0,0.2)';
        });
    });
</script>
@endsection
