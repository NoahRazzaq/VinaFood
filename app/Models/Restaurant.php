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

    public function products(){
        return $this->hasMany(Product::class,
        'restaurant_id',
        'id'
        );
    }


}
