<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavoritesRequest;
use App\Http\Requests\UpdateFavoritesRequest;
use App\Models\Favorite;
use App\Models\Favorites;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

    public function index()
    {
        // user connected
        $user = Auth::user();

        $favoriteProducts = $user->favorites;


        return view(
            'favorite/index',
            [
                'favoriteProducts' => $favoriteProducts
            ]
        );
    }


    public function store(Request $request, Product $product)
    {
        $user = Auth::user();

        $isLiked = $request->input('is_liked');

        if ($isLiked) {
            $isAlreadyLiked = $user->favorites()->where('product_id', $product->id)->exists();

            if (!$isAlreadyLiked) {
                $favorite = Favorite::create([
                    'product_id' => $product->id,
                    'user_id' => $user->id
                ]);
                smilify('success', 'Produit ajouté au favoris ❤️');
            }
        } else {
            $user->favorites()->detach($product->id);
        }

        $product->update(['is_liked' => $isLiked]);



        return redirect()->back();
    }
}
