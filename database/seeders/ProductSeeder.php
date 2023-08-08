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
        Restaurant::all()->each(function ($restaurant) {
            $categories = Category::all();
            $categories->each(function ($category) use ($restaurant) {
                Product::factory(5)->create([
                    'restaurant_id' => $restaurant->id,
                    'category_id' => $category->id,
                ]);
            });
        });
    }
}
