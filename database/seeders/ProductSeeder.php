<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'Ayam Geprek',
            'category_id' => 1,
            'description' => 'Ayam geprek pedas level 5',
            'price' => 23500,
            'stock' => 50,
            'rating' => 5.0,
            'image' => 'ayam-geprek.jpg',
            'is_recommendation' => true,
        ]);

        Product::create([
            'name' => 'Es Teh',
            'category_id' => 2,
            'description' => 'Es teh manis segar',
            'price' => 5000,
            'stock' => 200,
            'rating' => 4.8,
            'image' => 'es-teh.jpg',
            'is_recommendation' => false,
        ]);
    }
}
