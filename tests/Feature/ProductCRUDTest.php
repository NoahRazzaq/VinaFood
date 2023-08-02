<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductCRUDTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product()
    {
        $restaurant = Restaurant::factory()->create();
        $category = Category::factory()->create();

        $response = $this->post('/products/store', [
            'name' => 'Toto',
            'detail' => 'tata',
            'price' => 10.99,
            'restaurant' => $restaurant->id,
            'category' => $category->id
        ]);


        $response->assertRedirect('/products');
    }

    public function test_error_create_product()
    {
        $restaurant = Restaurant::factory()->create();
        $category = Category::factory()->create();

        $response = $this->post('/products/store', [
            'name' => 'New Product',
            'detail' => 'Product details',
            'price' => 'ee',
            'restaurant' => $restaurant->id,
            'category' => $category->id
        ]);
    
        $response->assertRedirect();
        // check the validation of a specific field
        $response->assertSessionHasErrors(['price']);
    
    }

    public function test_delete_product()
    {
        $product = Product::factory()->create();

        $response = $this->get("/products/deleteProduct/{$product->id}");

        $response->assertRedirect('/products');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_update_product()
    {
        $product = Product::factory()->create();
        $restaurant = Restaurant::factory()->create();
        $category = Category::factory()->create();

        $response = $this->put("/products/{$product->id}/edit", [
            'name' => 'Toto tata',
            'detail' => 'ttotototo',
            'price' => 5,
            'restaurant' => $restaurant->id,
            'category' => $category->id
        ]);

        $response->assertRedirect('/products');
    }

    public function test_error_update_product()
    {
        $product = Product::factory()->create();
        $restaurant = Restaurant::factory()->create();

        $response = $this->put("/products/{$product->id}/edit", [
            'name' => 'Toto tata',
            'detail' => 'ttotototo',
            'price' => 'zd',
            'restaurant' => $restaurant->id,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['price']);

    }


    




}
