<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('fr_FR');

        return [
            'name' => $this->faker->unique->word(),
            'phone' => $this->faker->regexify('/^[0-9]{10}$/'),
            'address' => $faker->address(),
            'cp' => str_replace(' ', '', $faker->postcode()),
            'city' => $faker->city(),
        ];
    }
}
