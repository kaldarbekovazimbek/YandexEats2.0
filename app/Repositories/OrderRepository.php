<?php

namespace App\Repositories;

use App\DTO\Order\OrderDTO;
use App\DTO\Order\UpdateOrderDTO;
use App\Interfaces\IOrderRepository;
use App\Models\Order;
use App\Models\RestaurantWorker;
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

    public function getByUserId(int $userId)
    {
        /**
         * @var Order
         */
        return Order::query()->where('user_id', $userId)->paginate(15);
    }

    public function getByRestaurantId(int $restaurantId)
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

        $order = $this->getById($orderId);
        $order->status = $updateOrderDTO->getStatus();
        $order->restaurant_worker_id = $updateOrderDTO->getWorkerId();
        $order->save();

        return $order;
    }
    public function getOrderById(int $workerId, int $orderId)
    {
        $worker = RestaurantWorker::query()->find($workerId);

        return Order::query()->where('restaurant_id', $worker->restaurant_id)->whereNull('restaurant_worker_id')->find($orderId);
    }
}
