<?php

namespace App\Services;

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
        $userOrder = $this->orderRepository->getByUserId($userId);
    }

}
