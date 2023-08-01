<?php

namespace Tests\Feature;

use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RestaurantCRUDTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_restaurant(): void
    {
        $response = $this->post('/restaurants/store', [
            'name' => 'Marcel',
            'phone' => '06 06 06 06 06',
            'address' => '123 rue',
            'city' => 'annecy',
            'cp' => '12345',
        ]);

        $response->assertRedirect('/restaurants');

        $this->assertDatabaseHas('restaurants', [
            'name' => 'Marcel',
            'phone' => '06 06 06 06 06',
            'address' => '123 rue',
            'city' => 'annecy',
            'cp' => '12345',
        ]);
    }

    public function test_error_create_restaurant(): void
    {
        $response = $this->post('/restaurants/store', [
            'name' => 'Marcel',
            'phone' => '06 06 06 06 06',
            'city' => 'annecy',
            'cp' => '12345',
        ]);

        $response->assertSessionHasErrors(['address']);
    }


    public function test_delete_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->get("/restaurants/deleteRestaurant/{$restaurant->id}");
        $response->assertRedirect('/restaurants');
        
        $this->assertDatabaseMissing('restaurants',[
            'id' => $restaurant->id
        ]);
    }

    public function test_update_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->put("/restaurants/{$restaurant->id}/edit", [
            'name' => 'Marcel',
            'phone' => '06 06 06 06 07',
            'address' => '123 rue',
            'city' => 'annecy',
            'cp' => '12345',
        ]);

        $response->assertRedirect('/restaurants');

        $this->assertDatabaseHas('restaurants', [
            'name' => 'Marcel',
            'phone' => '06 06 06 06 07',
            'address' => '123 rue',
            'city' => 'annecy',
            'cp' => '12345',
        ]);

    }

    public function test_error_update_restaurant(): void
    {
        $restaurant = Restaurant::factory()->create();

        $response = $this->put("/restaurants/{$restaurant->id}/edit", [
            'name' => 'Marcel',
            'phone' => 0606060607,
            'address' => '123 rue',
            'city' => 'annecy',
            'cp' => 12345,
        ]);

        $response->assertRedirect('/restaurants');

        $this->assertDatabaseHas('restaurants', [
            'name' => 'Marcel',
            'phone' => '06 06 06 06 07',
            'address' => '123 rue',
            'city' => 'annecy',
            'cp' => '12345',
        ]);

    }







}
