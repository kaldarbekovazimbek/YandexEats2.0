<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $user_id
 * @property int $restaurant_id
 * @property string $status
 * @property float $total_price
 * @property int $restaurant_worker_id
 */
class Order extends Model
{
    use HasFactory;

    public $fillable = [

    ];


    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function workers(): BelongsTo
    {
        return $this->belongsTo(RestaurantWorker::class);
    }
    public function deliveryDetail(): HasOne
    {
        return $this->hasOne(DeliveryDetail::class);
    }

}

