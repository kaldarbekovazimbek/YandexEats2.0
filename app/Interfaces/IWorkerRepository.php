<?php

namespace App\Interfaces;

use App\DTO\Worker\RegistrationWorkerDTO;
use App\Models\RestaurantWorker;

interface IWorkerRepository
{
    public function index();

    public function profile(): ?RestaurantWorker;

    public function getRestaurantWorkers(int $restaurantId);

    public function getByEmail(string $workerEmail): ?RestaurantWorker;

    public function create(RegistrationWorkerDTO $registrationWorkerDTO);

}
