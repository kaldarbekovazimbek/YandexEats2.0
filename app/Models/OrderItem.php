<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $order_id
 * @property int $dish_id
 * @property int $quantity
 * @property float $price
 */
class OrderItem extends Model
{
    use HasFactory;

    public $fillable = [
        'order_id',
        'dish_id',
        'quantity',

    ];
    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function dish():BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }
}
