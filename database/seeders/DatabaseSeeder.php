<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        DB::table('users')->insert([
            'name' => 'Admin Bank Sampah',
            'email' => 'admin@banksampah.com',
            'phone' => '081234567890',
            'address' => 'Jl. Lingkungan Hijau No. 1',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'saldo' => 0,
            'total_points' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create Sample User
        DB::table('users')->insert([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '081234567891',
            'address' => 'Jl. Damai No. 10',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'saldo' => 50000,
            'total_points' => 250,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create Waste Categories
        $categories = [
            [
                'name' => 'Plastik',
                'description' => 'Botol plastik, kantong plastik, kemasan plastik bersih',
                'price_per_kg' => 3000,
                'points_per_kg' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Kertas',
                'description' => 'Koran, majalah, kardus, kertas HVS bekas',
                'price_per_kg' => 2000,
                'points_per_kg' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Logam',
                'description' => 'Kaleng, aluminium, besi, tembaga',
                'price_per_kg' => 5000,
                'points_per_kg' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Botol Kaca',
                'description' => 'Botol kaca minuman, toples kaca',
                'price_per_kg' => 1500,
                'points_per_kg' => 15,
                'is_active' => true,
            ],
            [
                'name' => 'Elektronik',
                'description' => 'Barang elektronik bekas (dihitung per item)',
                'price_per_kg' => 10000,
                'points_per_kg' => 100,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            DB::table('waste_categories')->insert(array_merge($category, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        echo "✅ Seeding completed successfully!\n";
        echo "📧 Admin Email: admin@banksampah.com\n";
        echo "🔑 Admin Password: admin123\n";
        echo "📧 User Email: budi@example.com\n";
        echo "🔑 User Password: user123\n";
    }
}
