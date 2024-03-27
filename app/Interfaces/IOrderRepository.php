<?php

namespace App\Interfaces;

use App\DTO\Order\OrderDTO;
use App\DTO\Order\UpdateOrderDTO;
use App\Models\Order;

interface IOrderRepository
{
    public function getUserOrders();

    public function getById(int $orderId);

    public function getRestaurantOrders(int $restaurantId);

    public function create(OrderDTO $orderDTO): Order;

    public function update(int $orderId, UpdateOrderDTO $updateOrderDTO): ?Order;
}
