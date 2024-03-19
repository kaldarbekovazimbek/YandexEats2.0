<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $restaurant_id
 */
class RestaurantWorker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'restaurant_id'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

}
