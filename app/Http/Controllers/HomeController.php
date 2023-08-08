<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Utils\QueryBuilderUtils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    public function index ()
    {
        App::setLocale('fr');
        $currentDay = ucfirst(Carbon::now()->isoFormat('dddd'));

        $products = Product::with(['restaurant', 'category'])
            ->select('products.*')
            ->join('restaurants', 'products.restaurant_id', '=', 'restaurants.id')
            ->join('restaurant_available_day', 'restaurants.id', '=', 'restaurant_available_day.restaurant_id')
            ->join('available_days', 'restaurant_available_day.available_day_id', '=', 'available_days.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('available_days.day', $currentDay)
            ->distinct()
            ->get();

        return view('home', [
            'products' => $products
        ]);
    }
}
