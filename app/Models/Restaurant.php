<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'address',
        'phone',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function restaurantWorkers(): HasMany
    {
        return $this->hasMany(RestaurantWorker::class);
    }

    public function dishes():HasMany
    {
        return $this->hasMany(Dish::class);
    }
}
