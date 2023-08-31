<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $restaurants = Restaurant::all();
        $categories = Category::all();

        foreach ($restaurants as $restaurant) {
            foreach ($categories as $category) {
                $products = Product::factory(5)->create([
                    'restaurant_id' => $restaurant->id,
                    'category_id' => $category->id,
                ]);
                $restaurant->products()->saveMany($products);
            }
        }
    }
}
