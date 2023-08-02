<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index ()
    {
        $products = Product::all();
        return view("product/index", 
            ['products' => $products]);
    }

    public function show ($idProduct)
    {
        $product = Product::findOrFail($idProduct);

        return view("product/show", 
        ['product' => $product]);
    }

    public function create ()
    {
        $restaurants = Restaurant::all();
        $categories = Category::all();

        return view("product/form", [
            'restaurants' => $restaurants,
            'categories' => $categories
        ]);
    }



    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'detail' => 'required|max:255',
                'price' => 'required|numeric',
                'restaurant' => 'required'    
            ],

            [
                'name.max' => 'Le nom du produit doit contenir 255 caractères maximum',
                'detail.max' => 'Le détail doit contenir 255 caractères maximum',
                'price.numeric' => 'Le format du prix est invalide'
            ]
        );


        $product = Product::create([
            'name' => $validated['name'],
            'detail' => $validated['detail'],
            'price' => $validated['price'],
            'restaurant_id' => $validated['restaurant'],
            'category_id' => $request->input('category'),
        ]);


        return redirect('/products');
    }


    public function delete(Product $product)
    {
        $product->delete();
        return redirect("/products");
    }

    public function edit ($idProduct)
    {
        $product = Product::findOrFail($idProduct);
        $restaurants = Restaurant::all();
        $categories = Category::all();

        return view("product/edit", [
            'product' => $product,
            'restaurants' => $restaurants,
            'categories' => $categories
        ]);
    }


    public function update(Request $request, Product $product)
    {
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'detail' => 'required|max:255',
                'price' => 'required|numeric',
                'restaurant' => 'required'
            ],

            [
                'name.max' => 'Le nom du produit doit contenir 255 caractères maximum',
                'detail.max' => 'Le détail doit contenir 255 caractères maximum',
                'price.numeric' => 'Le format du prix est invalide'
            ]
        );
        $product->restaurant_id = $request->restaurant;
        $product->category_id = $request->category;

        $product->update($validated);

        return redirect("/products");
    }
}
