<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->get();
        return view(
            "product/index",
            ['products' => $products]
        );
    }

    public function show($idProduct)
    {
        $product = Product::findOrFail($idProduct);
        $users = User::all();

        return view("product/show", [
            'product' => $product,
            'users' => $users
        ]);
    }

    public function create()
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
                'price.numeric' => 'Le format du prix est invalide',

                'name.required' => 'Renseignez ici le nom du produit',
                'detail.required' => 'Renseignez ici la description du produit',
                'price.required' => 'Renseignez ici le prix du produit',
                'restaurant.required' => 'Renseignez ici le restaurant'
            ]
        );

        $imagePath = $request->file('image')->store('public');
        $imageRelativePath = str_replace('public/', '', $imagePath);


        $product = Product::create([
            'name' => $validated['name'],
            'detail' => $validated['detail'],
            'price' => $validated['price'],
            'image' => $imageRelativePath,
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

    public function edit($idProduct)
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
                'price.numeric' => 'Le format du prix est invalide',

                'name.required' => 'Renseignez ici le nom du produit',
                'detail.required' => 'Renseignez ici la description du produit',
                'price.required' => 'Renseignez ici le prix du produit',

            ]
        );

        
        $product->update($validated);

        $product->restaurant_id = $request->restaurant;
        $product->category_id = $request->category;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public');
            $imageRelativePath = str_replace('public/', '', $imagePath);
    
            $product->image = $imageRelativePath;
            $product->save();
        }

        return redirect("/products");
    }
}
