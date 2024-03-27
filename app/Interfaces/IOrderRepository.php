<?php

namespace App\Interfaces;

use App\DTO\Order\OrderDTO;
use App\DTO\Order\UpdateOrderDTO;
use App\Models\Order;

interface IOrderRepository
{
    public function getUserOrders();

    public function getOrderById(int $orderId);

    public function getRestaurantOrders();

    public function create(OrderDTO $orderDTO): Order;

    public function update(int $orderId, UpdateOrderDTO $updateOrderDTO): ?Order;
}
