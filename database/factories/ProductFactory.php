<?php

namespace Database\Factories;

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
        $resto = Restaurant::all()->random();

        return [
            'name' => $this->faker->word(),
            'detail' => $this -> faker->text(),
            'price' => round(rand(5, 30), 2),
            'restaurant_id' => $resto->id
        ];
    }
}
