<?php

namespace App\Services;

use App\DTO\Order\UpdateOrderDTO;
use App\Exceptions\NotFoundException;
use App\Interfaces\IOrderRepository;
use App\Models\Order;

class OrderService
{
    private IOrderRepository $orderRepository;

    /**
     * @param IOrderRepository $orderRepository
     */
    public function __construct(IOrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function getUserOrders()
    {
        return $this->orderRepository->getUserOrders();
    }

    /**
     * @throws NotFoundException
     */
    public function update(int $orderId, UpdateOrderDTO $updateOrderDTO): ?Order
    {
        $order = $this->orderRepository->getOrderById($orderId);
        if ($order === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $this->orderRepository->update($orderId, $updateOrderDTO);
    }

    /**
     * @throws NotFoundException
     */
    public function getById(int $orderId): Order
    {
        $order = $this->orderRepository->getOrderById($orderId);

        if ($order === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        return $order;
    }

    public function getRestaurantOrders()
    {
        return $this->orderRepository->getRestaurantOrders();
    }


}
