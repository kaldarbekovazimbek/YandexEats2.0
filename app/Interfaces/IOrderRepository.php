<?php

namespace App\Interfaces;

use App\DTO\OrderDTO;
use App\DTO\UpdateOrderDTO;
use App\Models\Order;

interface IOrderRepository
{
    public function index();

    public function getById(int $orderId): ?Order;

    public function getByUserId(int $userId);

    public function getByRestaurantId(int $restaurantId);

    public function create(OrderDTO $orderDTO): Order;

    public function update(int $orderId, UpdateOrderDTO $updateOrderDTO): ?Order;
}
