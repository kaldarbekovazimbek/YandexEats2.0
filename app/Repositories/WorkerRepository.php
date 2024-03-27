<?php

namespace App\Repositories;

use App\DTO\Worker\RegistrationWorkerDTO;
use App\Interfaces\IWorkerRepository;
use App\Models\Order;
use App\Models\RestaurantWorker;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class   WorkerRepository implements IWorkerRepository
{

    public function index(): LengthAwarePaginator
    {
        return RestaurantWorker::query()->paginate(15);
    }

    public function profile(): ?RestaurantWorker
    {
        /**
         * @var  RestaurantWorker
         */
        return Auth::user();
    }

    public function getByEmail(string $workerEmail): ?RestaurantWorker
    {
        /**
         * @var RestaurantWorker
         */
        return RestaurantWorker::query()->where('email', $workerEmail)->first();

    }


    public function getRestaurantWorkers(int $restaurantId): LengthAwarePaginator
    {
        return RestaurantWorker::query()->where('restaurant_id', $restaurantId)->paginate(15);
    }

}
