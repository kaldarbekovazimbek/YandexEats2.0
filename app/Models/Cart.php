<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property  $userId
 * @property int $dishId
 * @property int $quantity
 * @property float $totalPrice
 */
class Cart extends Model
{
    use HasFactory;
}
