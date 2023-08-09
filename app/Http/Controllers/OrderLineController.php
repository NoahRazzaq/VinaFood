<?php

namespace App\Http\Controllers;

use App\Events\OrderCreateEvent;
use App\Http\Requests\StoreOrderLineRequest;
use App\Http\Requests\UpdateOrderLineRequest;
use App\Models\Order;
use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderLineController extends Controller
{
    public function index ()
    {
        $orders = Order::with('products', 'restaurant')->get();

        return view("cart/index", [
            'orders' => $orders
        ]);
    }

    public function store (Request $request, Product $product)
    {
        //create order

        $order = Order::create([
            'restaurant_id' => $product->restaurant_id
        ]);

        // create orderline

        $orderline = OrderLine::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => $request->input('quantity'),
            'user_id' => $request->input('user_id')
        ]);


        return redirect("/cart");
        
    }

}
