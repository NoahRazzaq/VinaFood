<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'restaurant_id','mail_sent', 'created_at'
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(
            Restaurant::class,
            'restaurant_id',
            'id'
        );
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'orderline'
        )
            ->using(OrderLine::class)
            ->withPivot(['quantity']);
    }


    public function orderlines()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
