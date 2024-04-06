<?php

namespace App\Http\Resources;

use App\Models\RestaurantWorker;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property RestaurantWorker $resource
 */
class WorkerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->resource->id,
            'name'=>$this->resource->name,
            'email'=>$this->resource->email,
            'restaurant_id'=>$this->resource->restaurant_id
        ];
    }
}
