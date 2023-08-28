<?php

use App\Http\Controllers\AvailableDayController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\OrderLineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::controller(ProductController::class)->group(function () {
        Route::prefix('/products')->group(function () {

            Route::get('/', 'index')->name('product.index');
            Route::get('/create', 'create')->name('product.create');
            Route::post('/store', 'store')->name('product.store');
            Route::get('/{product}', 'show')->name('product.show');
            Route::get('/deleteProduct/{product}', 'delete')->name('product.delete');
            Route::get('/{product}/edit', 'edit')->name('product.edit');
            Route::put('/{product}/edit', 'update')->name('product.update');
        });
    });

    Route::controller(RestaurantController::class)->group(function () {
        Route::prefix('/restaurants')->group(function () {
            Route::get('/', 'index')->name('restaurant.index');
            Route::get('/create', 'create')->name('restaurant.create');
            Route::post('/store', 'store')->name('restaurant.store');
            Route::get('/{restaurant}', 'show')->name('restaurant.show');
            Route::get('/deleteRestaurant/{restaurant}', 'delete')->name('restaurant.delete');
            Route::get('/{restaurant}/edit', 'edit')->name('restaurant.edit');
            Route::put('/{restaurant}/edit', 'update')->name('restaurant.update');
        });
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::prefix('/categories')->group(function () {
            Route::get('/', 'index')->name('category.index');
            Route::get('/create', 'create')->name('category.create');
            Route::post('/store', 'store')->name('category.store');
            Route::get('/{category}', 'show')->name('category.show');
            Route::get('/deleteCategory/{category}', 'delete')->name('category.delete');
        });
    });

    Route::controller(OrderLineController::class)->group(function () {
        Route::prefix('/cart')->group(function () {
            Route::get('/', 'index')->name('cart.index');
            Route::post('/store/{product}', 'store')->name('cart.store');
            Route::get('/delete/{order}', 'destroy')->name('cart.destroy');
            Route::get('/confirmOrder/{order}', 'confirmOrder')->name('cart.confirmOrder');
            Route::post('/addPickupTime/{order}', 'addPickupTime')->name('cart.addPickupTime');
        });
    });

    Route::controller(AvailableDayController::class)->group(function () {
        Route::prefix('/days')->group(function () {
            Route::get('/', 'index')->name('day.index');
            Route::get('/{day}', 'show')->name('day.show');
        });
    });

    Route::controller(FavoriteController::class)->group(function () {
        Route::prefix('/favorites')->group(function () {
            Route::get('/', 'index')->name('favorite.index');
            Route::post('/store/{product}', 'store')->name('favorite.store');
        });
    });
});


require __DIR__ . '/auth.php';
