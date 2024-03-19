<?php

namespace App\Http\Resources;

use App\Models\Dish;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Restaurant $resource
 */
class RestaurantResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'address' => $this->resource->address,
            'phone' => $this->resource->phone,
            'menu'=>Dish::query()->where('restaurant_id', $this->resource->id)->paginate(15)
        ];
    }
}
