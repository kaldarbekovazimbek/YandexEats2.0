<?php

namespace App\DTO\Order;


class UpdateOrderDTO
{

    private string $status;
//    private int $restaurant_worker_id;


    public function __construct(string $status)
    {
        $this->status = $status;
//        $this->restaurant_worker_id = $restaurant_worker_id;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
//    public function getWorkerId(): int
//{
//    return $this->restaurant_worker_id;
//}

    public static function fromArray(array $data): static
    {
        return new static(
            status: $data['status'],
//            restaurant_worker_id: $data['restaurant_worker_id']
        );
    }

}
