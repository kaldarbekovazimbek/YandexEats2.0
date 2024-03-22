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

    /**
     * @throws NotFoundException
     */
    public function index()
    {
        $orders = $this->orderRepository->index();

        if ($orders === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        return $orders;
    }

    /**
     * @throws NotFoundException
     */
    public function update(int $orderId, UpdateOrderDTO $updateOrderDTO): ?Order
    {
        $order = $this->orderRepository->getById($orderId);
        if ($order === null){
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $this->orderRepository->update($orderId, $updateOrderDTO);
    }
    /**
     * @throws NotFoundException
     */
    public function getById(int $orderId): Order
    {
        $order = $this->orderRepository->getById($orderId);

        if ($order === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        return $order;
    }

    public function getByUserId(int $userId)
    {
        return $this->orderRepository->getByUserId($userId);

    }

    /**
     * @throws NotFoundException
     */
    public function getRestaurantById(int $restaurantId)
    {
        $restaurants = $this->orderRepository->getByRestaurantId($restaurantId);

        if ($restaurants === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $restaurants;
    }


}
