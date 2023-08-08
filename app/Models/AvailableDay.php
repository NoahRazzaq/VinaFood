<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AvailableDay extends Model
{
    use HasFactory;

    protected $table = "available_days";
    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'day'
    ];

    public function restaurants(): BelongsToMany
    {
        return $this->belongsToMany(Restaurant::class, 'restaurant_available_day', 'available_day_id', 'restaurant_id');
    }
}
