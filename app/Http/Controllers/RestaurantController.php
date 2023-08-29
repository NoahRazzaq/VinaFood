<?php

namespace App\Http\Controllers;

use App\Models\AvailableDay;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('availableDays')->get();

        return view('restaurant/index', [
            'restaurants' => $restaurants
        ]);
    }

    public function show(Restaurant $restaurant)
    {
        return view('restaurant/show', [
            'restaurant' => $restaurant
        ]);
    }

    public function create()
    {
        $days = AvailableDay::all();

        return view("restaurant/form", [
            'days' => $days
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(

            [
                'name' => 'required|max:255',
                'phone' => 'required|max:255',
                'address' => 'required|max:255',
                'city' => 'required|max:255',
                'cp' => ['required', 'regex:~^[0-9]{5}$~'],
            ],

            [
                'name.max' => 'Le nom du restaurant doit contenir 255 caractères maximum',
                'city.max' => 'La ville doit contenir 255 caractères maximum',
                'address.max' => 'Ladresse doit contenir 255 caractères maximum',
                'phone.regex' => 'Le format de téléphone est invalide.',
                'cp.regex' => 'Le format du code postal est invalide.',

                'name.required' => 'Renseignez ici le nom du restaurant',
                'phone.required' => 'Renseignez ici le numéro de téléphone du restaurant',
                'address.required' => 'Renseignez ici l\'adresse du restaurant',
                'city.required' => 'Renseignez ici la ville du restaurant',
                'cp.required' => 'Renseignez ici le code postale du restaurant',


            ]
        );


        $imagePath = $request->file('image')->store('public');
        $imageRelativePath = str_replace('public/', '', $imagePath);

        $restaurant = Restaurant::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'city' => $validated['city'],
            'cp' => $validated['cp'],
            'image' => $imageRelativePath,

        ]);

        $selectedDays = $request->input('days', []);

        /** @var Restaurant $restaurant */
        $restaurant->availableDays()->attach($selectedDays);

        smilify('success', 'Restaurant ajouté avec succès !');


        return redirect('/restaurants');
    }

    public function delete(Restaurant $restaurant)
    {
        $restaurant->delete();
        smilify('success', 'Restaurant supprimé avec succès !');

        return redirect("/restaurants");
    }

    public function edit(Restaurant $restaurant)
    {
        $days = AvailableDay::all();

        $selectedDays = $restaurant->availableDays()->select('available_days.id')->pluck('id')->toArray();

        return view("restaurant/edit", [
            'restaurant' => $restaurant,
            'days' => $days,
            'selectedDays' => $selectedDays
        ]);
    }

    public function update(Request $request, Restaurant $restaurant)
    {

        $validated = $request->validate(

            [
                'name' => 'required|max:255',
                'phone' => 'required|max:255',
                'address' => 'required|max:255',
                'city' => 'required|max:255',
                'cp' => ['required', 'regex:~^[0-9]{5}$~'],
            ],

            [
                'name.max' => 'Le nom du restaurant doit contenir 255 caractères maximum',
                'city.max' => 'La ville doit contenir 255 caractères maximum',
                'address.max' => 'Ladresse doit contenir 255 caractères maximum',
                'phone.regex' => 'Le format de téléphone est invalide.',
                'cp.regex' => 'Le format du code postal est invalide.',

                'name.required' => 'Renseignez ici le nom du restaurant',
                'phone.required' => 'Renseignez ici le numéro de téléphone du restaurant',
                'address.required' => 'Renseignez ici l\'adresse du restaurant',
                'city.required' => 'Renseignez ici la ville du restaurant',
                'cp.required' => 'Renseignez ici le code postale du restaurant',

            ]
        );

        $restaurant->update($validated);

        $restaurant->availableDays()->detach();

        if ($request->has('days')) {
            $days = $request->input('days');
            $restaurant->availableDays()->attach($days);
        }

        smilify('success', 'Restaurant modifié avec succès !');


        return redirect('/restaurants');
    }
}
