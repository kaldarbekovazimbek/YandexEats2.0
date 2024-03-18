<?php

namespace App\Interfaces;

use App\DTO\OrderDTO;
use App\Models\Order;

interface IOrderRepository
{
    public function index();

    public function getById(int $orderId): ?Order;

    public function getByUserId(int $userId): ?Order;

    public function getByRestaurantId(int $restaurantId): ?Order;

    public function create(OrderDTO $orderDTO): Order;

    public function update(int $orderId, OrderDTO $orderDTO): ?Order;

}
