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
        'name','detail','price','image','restaurant_id', 'category_id'
    ];


    public function restaurant(){
        return $this->belongsTo(Restaurant::class,
         'restaurant_id',
         'id'
         );
    }

    public function category(){
        return $this->belongsTo(Category::class,
         'category_id',
         'id'
         );
    }

}
