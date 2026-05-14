<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test merchant
        $merchant = User::create([
            'name' => 'Merchant Test',
            'email' => 'merchant@test.com',
            'password' => 'password123',
            'role' => 'merchant',
        ]);

        // Create test categories
        Category::create([
            'merchant_id' => $merchant->id,
            'name' => 'Elektronik',
            'description' => 'Produk elektronik dan gadget terbaru',
            'slug' => 'elektronik',
        ]);

        Category::create([
            'merchant_id' => $merchant->id,
            'name' => 'Pakaian',
            'description' => 'Koleksi pakaian untuk pria dan wanita',
            'slug' => 'pakaian',
        ]);

        Category::create([
            'merchant_id' => $merchant->id,
            'name' => 'Makanan & Minuman',
            'description' => 'Makanan dan minuman berkualitas',
            'slug' => 'makanan-minuman',
        ]);
    }
}
