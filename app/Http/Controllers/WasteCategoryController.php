<?php

namespace App\Http\Controllers;

use App\Models\WasteCategory;
use Illuminate\Http\Request;

class WasteCategoryController extends Controller
{
    public function index()
    {
        $categories = WasteCategory::latest()->paginate(20);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_kg' => 'required|numeric|min:0',
            'points_per_kg' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        WasteCategory::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori sampah berhasil ditambahkan.');
    }

    public function show(WasteCategory $category)
    {
        $category->load(['transactions' => function($query) {
            $query->where('status', 'approved')->latest()->take(10);
        }]);
        
        return view('categories.show', compact('category'));
    }

    public function edit(WasteCategory $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, WasteCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price_per_kg' => 'required|numeric|min:0',
            'points_per_kg' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori sampah berhasil diperbarui.');
    }

    public function destroy(WasteCategory $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori sampah berhasil dihapus.');
    }
}
