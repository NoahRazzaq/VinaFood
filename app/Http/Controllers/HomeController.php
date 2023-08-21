<?php

namespace App\Http\Controllers;

use App\Models\AvailableDay;
use App\Models\Product;
use App\Models\Restaurant;
use App\Utils\QueryBuilderUtils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        App::setLocale('fr');
        $currentDay = ucfirst(Carbon::now()->isoFormat('dddd'));

        // products available
        $products = Product::with(['restaurant', 'category'])
            ->select('products.*')
            ->join('restaurants', 'products.restaurant_id', '=', 'restaurants.id')
            ->join('restaurant_available_day', 'restaurants.id', '=', 'restaurant_available_day.restaurant_id')
            ->join('available_days', 'restaurant_available_day.available_day_id', '=', 'available_days.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('available_days.day', $currentDay)
            ->distinct()
            ->get();


        //restaurants available 
        $availableRestaurantIds = Restaurant::whereHas('availableDays', function ($query) use ($currentDay) {
            $query->where('day', $currentDay);
        })->pluck('id');

        $restaurants = Restaurant::whereIn('id', $availableRestaurantIds)->get();

        //favorites product
        $user = Auth::user();
        $favoriteProducts = $user->favorites;

        return view('home', [
            'products' => $products,
            'restaurants' => $restaurants,
            'favoriteProducts' => $favoriteProducts
        ]);
    }
}
