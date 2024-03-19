<?php

namespace App\Http\Resources;

use App\Models\RestaurantWorker;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property RestaurantWorker $resource
 */
class RestaurantWorkerResource extends JsonResource
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
            'password'=>$this->resource->password,
            'restaurant_id'=>$this->resource->restaurant_id
        ];
    }
}
