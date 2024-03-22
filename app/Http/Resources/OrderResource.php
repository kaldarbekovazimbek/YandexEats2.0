<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Order $resource
 */
class OrderResource extends JsonResource
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
            'user_id' =>  $this->resource->user_id,
            'restaurant_id'=> $this->resource->restaurant_id,
            'status' => $this->resource->status,
            'total_price'=>$this->resource->total_price,
            'restaurant_worker_id'=>$this->resource->restaurant_worker_id
        ];
    }
}
