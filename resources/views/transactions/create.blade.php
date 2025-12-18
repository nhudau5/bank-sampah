@extends('layouts.app')

@section('title', 'Buat Transaksi Baru - Bank Sampah')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <a href="{{ route('transactions.index') }}" class="text-blue-600 hover:text-blue-800 mb-4 inline-block">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Buat Transaksi Baru</h1>
        <p class="text-gray-600 mt-1">Setor sampah Anda untuk mendapatkan saldo dan poin</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf

            <!-- Waste Category Selection -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Kategori Sampah <span class="text-red-500">*</span>
                </label>
                <select name="waste_category_id" id="waste_category_id" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('waste_category_id') border-red-500 @enderror"
                        required>
                    <option value="">Pilih Kategori Sampah</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                            data-price="{{ $category->price_per_kg }}"
                            data-points="{{ $category->points_per_kg }}">
                        {{ $category->name }} (Rp {{ number_format($category->price_per_kg, 0, ',', '.') }}/kg)
                    </option>
                    @endforeach
                </select>
                @error('waste_category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Weight Input -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Berat Sampah (kg) <span class="text-red-500">*</span>
                </label>
                <input type="number" 
                       name="weight" 
                       id="weight"
                       step="0.01" 
                       min="0.1"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('weight') border-red-500 @enderror"
                       placeholder="Masukkan berat dalam kilogram"
                       required>
                @error('weight')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Calculation Preview -->
            <div id="calculation-preview" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg hidden">
                <h3 class="font-semibold text-gray-800 mb-3">Perhitungan:</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Harga per kg:</span>
                        <span class="font-medium" id="price-per-kg">Rp 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Berat:</span>
                        <span class="font-medium" id="weight-display">0 kg</span>
                    </div>
                    <div class="border-t border-green-300 pt-2 mt-2 flex justify-between">
                        <span class="font-semibold text-gray-800">Total Saldo:</span>
                        <span class="font-bold text-green-600" id="total-price">Rp 0</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-semibold text-gray-800">Poin Diterima:</span>
                        <span class="font-bold text-yellow-600" id="total-points">0 poin</span>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Catatan (Opsional)
                </label>
                <textarea name="notes" 
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                          placeholder="Tambahkan catatan jika diperlukan"></textarea>
            </div>

            <!-- Info Box -->
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex">
                    <i class="fas fa-info-circle text-blue-600 mr-3 mt-1"></i>
                    <div class="text-sm text-blue-800">
                        <p class="font-medium mb-1">Catatan Penting:</p>
                        <ul class="list-disc list-inside space-y-1 text-blue-700">
                            <li>Transaksi akan diproses setelah disetujui oleh admin</li>
                            <li>Pastikan sampah dalam kondisi bersih dan sudah dipilah</li>
                            <li>Saldo dan poin akan masuk setelah transaksi disetujui</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="flex gap-3">
                <button type="submit" 
                        class="flex-1 bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-200 font-medium">
                    <i class="fas fa-check mr-2"></i>Buat Transaksi
                </button>
                <a href="{{ route('transactions.index') }}" 
                   class="px-6 py-3 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200 font-medium text-gray-700">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Calculate transaction preview
    function calculateTransaction() {
        const categorySelect = document.getElementById('waste_category_id');
        const weightInput = document.getElementById('weight');
        const preview = document.getElementById('calculation-preview');
        
        if (categorySelect.value && weightInput.value) {
            const selectedOption = categorySelect.options[categorySelect.selectedIndex];
            const pricePerKg = parseFloat(selectedOption.dataset.price);
            const pointsPerKg = parseInt(selectedOption.dataset.points);
            const weight = parseFloat(weightInput.value);
            
            if (weight > 0) {
                const totalPrice = pricePerKg * weight;
                const totalPoints = Math.floor(pointsPerKg * weight);
                
                document.getElementById('price-per-kg').textContent = 
                    'Rp ' + pricePerKg.toLocaleString('id-ID');
                document.getElementById('weight-display').textContent = 
                    weight.toFixed(2) + ' kg';
                document.getElementById('total-price').textContent = 
                    'Rp ' + Math.floor(totalPrice).toLocaleString('id-ID');
                document.getElementById('total-points').textContent = 
                    totalPoints.toLocaleString('id-ID') + ' poin';
                
                preview.classList.remove('hidden');
            } else {
                preview.classList.add('hidden');
            }
        } else {
            preview.classList.add('hidden');
        }
    }
    
    document.getElementById('waste_category_id').addEventListener('change', calculateTransaction);
    document.getElementById('weight').addEventListener('input', calculateTransaction);
</script>
@endpush
@endsection
