<?php

namespace App\DTO;


class OrderDTO
{
    private int $userId;
    private int $restaurantId;
    private string $status;
    private float $totalPrice;
    private int $restaurantWorkerId;

    /**
     * @param int $userId
     * @param int $restaurantId
     * @param string $status
     * @param float $totalPrice
     * @param int $restaurantWorkerId
     */
    public function __construct(int $userId, int $restaurantId, string $status, float $totalPrice, int $restaurantWorkerId)
    {
        $this->userId = $userId;
        $this->restaurantId = $restaurantId;
        $this->status = $status;
        $this->totalPrice = $totalPrice;
        $this->restaurantWorkerId = $restaurantWorkerId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getRestaurantId(): int
    {
        return $this->restaurantId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    public function getRestaurantWorkerId(): int
    {
        return $this->restaurantWorkerId;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            userId: $data['user_id'],
            restaurantId: $data['restaurant_id'],
            status: $data['status'],
            totalPrice: $data['total_price'],
            restaurantWorkerId: $data['restaurant_worker_id']
        );
    }

}
