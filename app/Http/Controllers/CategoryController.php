<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index ()
    {
        $categories = Category::all();

        return view ('category/index', [
            'categories' => $categories
        ]);
    }

    public function show ($idCategory)
    {
        $category = Category::findOrFail($idCategory);

        return view ('category/show', [
            'category' => $category
        ]);
    }

    public function create ()
    {
        return view("category/form");
    }

    public function store (Request $request)
    {
        $validated = $request->validate(
        [
            'name' => 'required|max:255'
        ],
        [
            'name.max' => 'Le nom du produit doit contenir 255 caractères maximum',
            'name.required' => 'Le nom est requis',
        ]
    );

        $category = Category::create([
            'name' => $validated['name']
        ]);

        return redirect('/categories');
    }

    public function delete (Category $category)
    {
        $category->delete();
        return redirect('/categories');
    }

}
