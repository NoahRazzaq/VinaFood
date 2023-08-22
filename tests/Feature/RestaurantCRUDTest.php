<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RestaurantCRUDTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $restaurant;
    private $category;
    private $product;
    
    public function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->restaurant = Restaurant::factory()->create();
        $this->category = Category::factory()->create();
        $this->product = Product::factory()->create();

    }
    public function test_create_restaurant(): void
    {
        $response = $this->actingAs($this->user)->post('/restaurants/store', [
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
        $response = $this->actingAs($this->user)->post('/restaurants/store', [
            'name' => 'Marcel',
            'phone' => '06 06 06 06 06',
            'city' => 'annecy',
            'cp' => '12345',
        ]);

        $response->assertSessionHasErrors(['address']);
    }

    public function test_update_restaurant(): void
    {
        $response = $this->actingAs($this->user)->put("/restaurants/{$this->restaurant->id}/edit", [
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
        $response = $this->actingAs($this->user)->put("/restaurants/{$this->restaurant->id}/edit", [
            'name' => 'Marcel',
            'phone' => '0606060607',
            'address' => '123 rue',
            'city' => 'annecy',
            'cp' => 1234577,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['cp']);


    }

    public function test_delete_restaurant(): void
    {
        $response = $this->actingAs($this->user)->get("/restaurants/deleteRestaurant/{$this->restaurant->id}");
        $response->assertRedirect('/restaurants');
        
        $this->assertDatabaseMissing('restaurants',[
            'id' => $this->restaurant->id
        ]);
    }








}
