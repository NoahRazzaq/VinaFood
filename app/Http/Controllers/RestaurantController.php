<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index ()
    {
        $restaurants = Restaurant::all();
        
        return view('restaurant/index', [
            'restaurants' => $restaurants
        ]);
    }

    public function show ($idRestaurant)
    {
        $restaurant = Restaurant::findOrFail($idRestaurant);

        return view ('restaurant/show', [
            'restaurant' => $restaurant
        ]);
    }

    public function create ()
    {
        return view("restaurant/form");
    }

    public function store (Request $request)
    {


        $validated = $request->validate(

            [
                'name'=>'required|max:255',
                'phone' => 'required|max:255',
                'address' => 'required|max:255',
                'city' =>'required|max:255',
                'cp' => ['required', 'regex:~^[0-9]{5}$~'],
            ],

            [
                'nom.max'=>'Le nom du restaurant doit contenir 255 caractères maximum',
                'city.max'=>'La ville doit contenir 255 caractères maximum',
                'address.max'=>'Ladresse doit contenir 255 caractères maximum',
                'phone.regex' =>'Le format de téléphone est invalide.',
                'cp.regex' => 'Le format du code postal est invalide.'

            ]
            );


            $restaurant = Restaurant::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'cp' => $validated['cp'],
            ]);


            return redirect('/restaurants');

    }

    public function delete(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect("/restaurants");
    }

    public function edit ($idRestaurant)
    {
        $restaurant = Restaurant::findOrFail($idRestaurant);
        return view("restaurant/edit", [
            'restaurant' => $restaurant
        ]);
    
    }

    public function update (Request $request, Restaurant $restaurant)
    {

        $validated = $request->validate(

            [
                'name'=>'required|max:255',
                'phone' => 'required|max:255',
                'address' => 'required|max:255',
                'city' =>'required|max:255',
                'cp' => ['required', 'regex:~^[0-9]{5}$~'],
            ],

            [
                'nom.max'=>'Le nom du restaurant doit contenir 255 caractères maximum',
                'city.max'=>'La ville doit contenir 255 caractères maximum',
                'address.max'=>'Ladresse doit contenir 255 caractères maximum',
                'phone.regex' =>'Le format de téléphone est invalide.',
                'cp.regex' => 'Le format du code postal est invalide.'

            ]
            );


            $restaurant->update($validated);

            return redirect('/restaurants');
    }

}
