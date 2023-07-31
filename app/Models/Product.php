<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'name','detail','price','image','restaurant_id'
    ];


    public function restaurant(){
        return $this->belongsTo(Restaurant::class,
         'restaurant_id',
         'id'
         );
    }

}
