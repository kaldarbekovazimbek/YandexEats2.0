<?php

namespace App\Repositories;

use App\DTO\Order\OrderDTO;
use App\DTO\Order\UpdateOrderDTO;
use App\Interfaces\IOrderRepository;
use App\Models\Order;
use App\Models\RestaurantWorker;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;


class OrderRepository implements IOrderRepository
{

    public function getUserOrders(): LengthAwarePaginator
    {
        $userId = Auth::user()->id;
        return Order::query()->where('user_id', $userId)->paginate(15);
    }

    public function getOrderById(int $orderId)
    {
        $userId = Auth::user()->id;

        return Order::query()->where('user_id', $userId)->where('id', $orderId)->find($orderId);
    }

    public function getRestaurantOrders(): LengthAwarePaginator
    {
        /**
         * @var Order
         */
        $user = Auth::user();
        $restaurantId = $user->restaurant_id;
        return Order::query()->where('restaurant_id', $restaurantId)->where('status', "!=", 'delivered')->paginate(15);
    }


    public function update(int $orderId, UpdateOrderDTO $updateOrderDTO): ?Order
    {
        /**
         * @var Order $order
         */
        $order = $this->getOrderById($orderId);
        $order->status = $updateOrderDTO->getStatus();
        $order->restaurant_worker_id = Auth::user()->id;
        $order->save();

        $order->deliveryDetail()->where('delivered_at', now());
        return $order;
    }
}
