<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = "favorites";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'product_id', 'user_id'
    ];

   
}
