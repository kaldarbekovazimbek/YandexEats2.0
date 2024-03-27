<?php

namespace App\Repositories;

use App\DTO\OrderItem\OrderItemDTO;
use App\Models\Order;
use App\Models\OrderItem;

class OrderItemRepository
{
    public function create(OrderItemDTO $orderItemDTO): OrderItem
    {
        $orderItem = new OrderItem();
        $orderItem->order_id = $orderItemDTO->getOrderId();
        $orderItem->dish_id = $orderItemDTO->getDishId();
        $orderItem->quantity = $orderItemDTO->getQuantity();
        $orderItem->save();

        return $orderItem;
    }
}
