<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderLine extends Pivot
{
    use HasFactory;
    protected $table = "orderline";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'user_id'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
