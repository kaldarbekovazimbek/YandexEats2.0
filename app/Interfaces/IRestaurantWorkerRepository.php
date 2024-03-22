<?php

namespace App\Interfaces;

use App\DTO\Restaurant\RestaurantWorkerDTO;
use App\Models\RestaurantWorker;

interface IRestaurantWorkerRepository
{
    public function index();

    public function getById(int $workerId): ?RestaurantWorker;

    public function getByRestaurant(int $restaurantId);

    public function getByEmail(string $workerEmail): ?RestaurantWorker;

    public function create(RestaurantWorkerDTO $workerDTO): RestaurantWorker;

    public function update(int $workerId, RestaurantWorkerDTO $workerDTO): ?RestaurantWorker;

    public function getOrdersList(int $workerId);
    public function getOrderById(int $workerId, int $orderId);

}
