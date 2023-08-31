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
use McKenziearts\Notify\Facades\Notify;


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
            ->where('available_days.day', $currentDay)
            ->distinct()
            ->get();

        $randomAvailableProduct = $products->isNotEmpty() ? $products->random() : null;


        //restaurants available 
        //
        $restaurants = Restaurant::whereHas('availableDays', function ($query) use ($currentDay) {
            $query->where('day', $currentDay);
        })->get();
        

        //favorites product
        $user = Auth::user();
        $favoriteProducts = $user->favorites;

        $favoriteProduct = $favoriteProducts->isNotEmpty() ? $favoriteProducts->random() : null;


        $randomProducts = Product::all()->random(4);

        $randomRestaurants = Restaurant::all()->random(6);

        // dd($favoriteProduct);
        return view('home', [
            'products' => $products,
            'restaurants' => $restaurants,
            'favoriteProducts' => $favoriteProducts,
            'favoriteProduct' => $favoriteProduct,
            'randomAvailableProduct' => $randomAvailableProduct,
            'randomProducts' => $randomProducts,
            'randomRestaurants' => $randomRestaurants
        ]);
    }
}
