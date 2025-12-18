<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah - Kelola Sampah, Raih Manfaat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-green-50 to-green-100">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-4xl w-full">
            <!-- Logo and Title -->
            <div class="text-center mb-12">
                <div class="inline-block bg-green-600 rounded-full p-6 mb-6 shadow-lg">
                    <i class="fas fa-recycle text-white text-6xl"></i>
                </div>
                <h1 class="text-5xl font-bold text-gray-800 mb-4">Bank Sampah</h1>
                <p class="text-xl text-gray-600">Kelola Sampah, Raih Manfaat</p>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="p-8 md:p-12">
                    <!-- Features -->
                    <div class="grid md:grid-cols-3 gap-6 mb-10">
                        <div class="text-center p-6 bg-green-50 rounded-lg">
                            <div class="bg-green-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-exchange-alt text-white text-2xl"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-2">Tukar Sampah</h3>
                            <p class="text-sm text-gray-600">Setorkan sampah anorganik Anda</p>
                        </div>
                        
                        <div class="text-center p-6 bg-yellow-50 rounded-lg">
                            <div class="bg-yellow-500 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-coins text-white text-2xl"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-2">Dapatkan Saldo</h3>
                            <p class="text-sm text-gray-600">Konversi menjadi saldo digital</p>
                        </div>
                        
                        <div class="text-center p-6 bg-blue-50 rounded-lg">
                            <div class="bg-blue-600 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-star text-white text-2xl"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-2">Kumpulkan Poin</h3>
                            <p class="text-sm text-gray-600">Raih reward dari aktivitas Anda</p>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('login') }}" 
                           class="flex-1 sm:flex-none bg-green-600 text-white px-8 py-4 rounded-lg hover:bg-green-700 transition duration-200 text-center font-semibold shadow-lg">
                            <i class="fas fa-sign-in-alt mr-2"></i>Masuk
                        </a>
                        <a href="{{ route('register') }}" 
                           class="flex-1 sm:flex-none bg-white border-2 border-green-600 text-green-600 px-8 py-4 rounded-lg hover:bg-green-50 transition duration-200 text-center font-semibold">
                            <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
                        </a>
                    </div>

                    <!-- Info -->
                    <div class="mt-10 p-6 bg-gradient-to-r from-green-600 to-green-500 rounded-lg text-white">
                        <h3 class="font-semibold text-lg mb-3">Mengapa Bank Sampah?</h3>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mr-3 mt-1"></i>
                                <span>Kurangi sampah, tingkatkan kesadaran lingkungan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mr-3 mt-1"></i>
                                <span>Dapatkan penghasilan tambahan dari sampah anorganik</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mr-3 mt-1"></i>
                                <span>Sistem poin dan reward menarik</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mr-3 mt-1"></i>
                                <span>Laporan digital yang transparan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8 text-gray-600">
                <p>&copy; 2025 Bank Sampah. Bersama Jaga Lingkungan.</p>
            </div>
        </div>
    </div>
</body>
</html>
