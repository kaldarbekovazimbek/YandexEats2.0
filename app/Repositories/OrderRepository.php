<?php

namespace App\Repositories;

use App\DTO\Order\OrderDTO;
use App\DTO\Order\UpdateOrderDTO;
use App\Interfaces\IOrderRepository;
use App\Models\Order;
use App\Models\RestaurantWorker;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;


class OrderRepository implements IOrderRepository
{

    public function getUserOrders(): LengthAwarePaginator
    {
        $userId = Auth::user()->id;
        return Order::query()->where('user_id', $userId)->paginate(15);
    }

    public function getById(int $orderId)
    {
        $userId = Auth::user()->id;

        return Order::query()->where('user_id', $userId)->find($orderId);
    }

    public function getRestaurantOrders(int $restaurantId): Order
    {
        /**
         * @var Order
         */
        return Order::query()->where('restaurant_id', $restaurantId)->paginate(15);
    }

    public function create(OrderDTO $orderDTO): Order
    {
        $order = new Order();
        $order->user_id = $orderDTO->getUserId();
        $order->restaurant_id = $orderDTO->getRestaurantId();
        $order->status = $orderDTO->getStatus();
        $order->total_price = $orderDTO->getTotalPrice();
        $order->save();

        return $order;
    }

    public function update(int $orderId, UpdateOrderDTO $updateOrderDTO): ?Order
    {
        /**
         * @var Order $order
         */
        $order = $this->getById($orderId);
        $order->status = $updateOrderDTO->getStatus();
        $order->restaurant_worker_id = $updateOrderDTO->getWorkerId();
        $order->save();

        return $order;
    }
}
