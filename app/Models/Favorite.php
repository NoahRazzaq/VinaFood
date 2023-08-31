<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Favorite extends Pivot
{
    use HasFactory;

    protected $table = "favorites";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'product_id', 'user_id'
    ];

   
}
