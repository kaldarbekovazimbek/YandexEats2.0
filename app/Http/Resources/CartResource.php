<?php

namespace App\Http\Resources;

use App\Http\Controllers\CartController;
use App\Models\Cart;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Cart $resource
 */
class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'user_id' => $this->resource->userId,
            'dish_id' => $this->resource->dishId,
            'quantity' => $this->resource->quantity,
        ];
    }
}
