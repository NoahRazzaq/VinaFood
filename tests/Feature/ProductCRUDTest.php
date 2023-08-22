<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductCRUDTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $restaurant;
    private $category;
    private $product;
    

    public function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        
        $this->user = User::factory()->create();
        $this->restaurant = Restaurant::factory()->create();
        $this->category = Category::factory()->create();
        $this->product = Product::factory()->create();

    }

    public function test_create_product()
    {
        Storage::fake('public'); // This is to fake file storage
        $response = $this->actingAs($this->user)->post('/products/store', [
            'name' => 'Toto',
            'detail' => 'tata',
            'price' => 10.99,
            'restaurant' => $this->restaurant->id,
            'category' => $this->category->id,
            'image' => UploadedFile::fake()->image('test_image.jpg'),
        ]);


        $response->assertRedirect('/products');
    }

    public function test_error_create_product()
    {

        $response = $this->actingAs($this->user)->post('/products/store', [
            'name' => 'New Product',
            'detail' => 'Product details',
            'price' => 'ee',
            'restaurant' => $this->restaurant->id,
            'category' => $this->category->id
        ]);
    
        $response->assertRedirect();
        // check the validation of a specific field
        $response->assertSessionHasErrors(['price']);
    
    }

    public function test_delete_product()
    {

        $response = $this->actingAs($this->user)->get("/products/deleteProduct/{$this->product->id}");

        $response->assertRedirect('/products');

        $this->assertDatabaseMissing('products', [
            'id' => $this->product->id,
        ]);
    }

    public function test_update_product()
    {

        $response = $this->actingAs($this->user)->put("/products/{$this->product->id}/edit", [
            'name' => 'Toto tata',
            'detail' => 'ttotototo',
            'price' => 5,
            'restaurant' => $this->restaurant->id,
            'category' => $this->category->id
        ]);

        $response->assertRedirect('/products');
    }

    public function test_error_update_product()
    {

        $response = $this->actingAs($this->user)->put("/products/{$this->product->id}/edit", [
            'name' => 'Toto tata',
            'detail' => 'ttotototo',
            'price' => 'zd',
            'restaurant' => $this->restaurant->id,
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['price']);

    }
}
