<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $category
 * @property int $restaurantId
 */
class Dish extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'descriptions',
        'price',
        'category',
//        'restaurant_id'
    ];

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
