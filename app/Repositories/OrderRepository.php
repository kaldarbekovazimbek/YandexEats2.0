<?php

namespace App\Repositories;

use App\DTO\OrderDTO;
use App\Interfaces\IOrderRepository;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class OrderRepository implements IOrderRepository
{

    public function index(): LengthAwarePaginator
    {
        return Order::query()->paginate(15);
    }

    public function getById(int $orderId): ?Order
    {
        /**
         * @var Order
         */
        return Order::query()->find($orderId);
    }

    public function getByUserId(int $userId): ?Order
    {
        /**
         * @var Order
         */
        return Order::query()->where('userId', $userId);
    }

    public function getByRestaurantId(int $restaurantId): ?Order
    {
        /**
         * @var Order
         */
        return Order::query()->where('restaurant_id', $restaurantId);
    }

    public function create(OrderDTO $orderDTO): Order
    {
        $order = new Order();

        
    }

    public function update(int $orderId, OrderDTO $orderDTO): ?Order
    {
        // TODO: Implement update() method.
    }
}
