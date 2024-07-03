<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Product::create([
                'product_category_id' => rand(1, 5),
                'name' => "Product $i",
                'price' => rand(10, 100),
                'qty' => rand(1, 50),
                'description' => "Description for Product $i",
            ]);
        }
    }
}
