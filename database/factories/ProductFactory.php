<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'detail' => $this -> faker->text(),
            'price' => round(rand(5, 30), 2),
            'image' => $this->faker->image(null, 360, 360, 'animals', true, true, 'cats', true, 'jpg'),
            'restaurant_id' => Restaurant::factory(),
            'category_id' => Category::factory()
        ];
    }
}
