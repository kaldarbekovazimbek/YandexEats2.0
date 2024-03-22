<?php

namespace App\Http\Resources;

use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Dish $resource
 */
class DishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'descriptions' => $this->resource->descriptions,
            'price' => $this->resource->price,
            'category' => $this->resource->category,
            'restaurant_id' => $this->resource->restaurant_id
        ];
    }
}
