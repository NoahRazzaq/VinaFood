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
            'name' => $faker->unique->company(),
            'phone' => $faker->phoneNumber(),
            'address' => $faker->streetAddress(),
            'cp' => str_replace(' ', '', $faker->postcode()),
            'image' => $this->faker->image(null, 360, 360, 'animals', true, true, 'cats', true, 'jpg'),
            'city' => $faker->city(),
        ];
    }
}
