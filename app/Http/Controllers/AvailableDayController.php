<?php

namespace App\Http\Controllers;

use App\Models\AvailableDay;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Cache\DynamoDbLock;
use Illuminate\Http\Request;

class AvailableDayController extends Controller
{
    public function index ()
    {
        $days = AvailableDay::all();

        return view(
            "availableDay/index",
            ['days' => $days]
        );
    }

    public function show (AvailableDay $day)
    {
        return view("availableDay/show", [
            'day' => $day
        ]);
    }
}
