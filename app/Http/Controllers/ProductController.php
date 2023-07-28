<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
        return view("product/form");
    }



    public function store(Request $request)
    {
        $validated = $request->validate(
            [

                'name' => 'required|max:255',
                'detail' => 'required|max:255',
                'price' => 'required|numeric',
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
        return view("product/edit", [
            'product' => $product
        ]);
    }


    public function update(Request $request, Product $product)
    {
        $validated = $request->validate(
            [

                'name' => 'required|max:255',
                'detail' => 'required|max:255',
                'price' => 'required|numeric',
            ],

            [
                'name.max' => 'Le nom du produit doit contenir 255 caractères maximum',
                'detail.max' => 'Le détail doit contenir 255 caractères maximum',
                'price.numeric' => 'Le format du prix est invalide'
            ]
        );

        $product->update($validated);


        return redirect("/products");
    }
}
