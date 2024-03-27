<?php

namespace App\DTO\OrderItem;

use App\Jobs\SendConfirmCodeJob;

class OrderItemDTO
{
    private int $orderId;
    private int $dishId;
    private int $quantity;

    /**
     * @param int $orderId
     * @param int $dishId
     * @param int $quantity
     */
    public function __construct(int $orderId, int $dishId, int $quantity)
    {
        $this->orderId = $orderId;
        $this->dishId = $dishId;
        $this->quantity = $quantity;
    }

    public function getOrderId(): int
    {
        return $this->orderId;
    }

    public function getDishId(): int
    {
        return $this->dishId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public static function fromArray(array $data):static
    {
        return new static(
            orderId: $data['order_id'],
            dishId: $data['dish_id'],
            quantity: $data['quantity']
        );
    }

}
