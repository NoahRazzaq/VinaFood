<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = "restaurants";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'cp',
        'city',
        'image'
    ];

    public function products()
    {
        return $this->hasMany(
            Product::class,
            'restaurant_id',
            'id'
        );
    }


    public function availableDays()
    {
        return $this->belongsToMany(AvailableDay::class, 'restaurant_available_day', 'restaurant_id', 'available_day_id');
    }

    public function orders()
    {
        return $this->hasMany(
            Order::class,
            'order_id',
            'id'
        );
    }
}
