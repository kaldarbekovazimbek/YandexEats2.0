<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
/**
 * @property int $id
 * @property int $order_id
 * @property string $delivery_address
 * @property string $delivered_at
 */
class DeliveryDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'delivery_details';

    public $fillable = [
        'order_id',
        'delivery_address',
    ];
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

}
