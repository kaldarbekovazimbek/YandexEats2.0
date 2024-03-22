<?php

namespace App\Repositories;

use App\DTO\RestaurantWorkerDTO;
use App\DTO\UserDTO;
use App\Interfaces\IRestaurantWorkerRepository;
use App\Interfaces\IUserRepository;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\RestaurantWorker;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class   RestaurantWorkerRepository implements IRestaurantWorkerRepository
{

    public function index(): LengthAwarePaginator
    {
        return RestaurantWorker::query()->paginate(15);
    }

    public function getById(int $workerId): ?RestaurantWorker
    {
        /**
         * @var  RestaurantWorker
         */
        return RestaurantWorker::query()->find($workerId);
    }

    public function getByEmail(string $workerEmail): ?RestaurantWorker
    {
        /**
         * @var RestaurantWorker
         */
        return RestaurantWorker::query()->where('email', $workerEmail)->first();

    }

    public function create(RestaurantWorkerDTO $workerDTO): RestaurantWorker
    {

        $worker = new RestaurantWorker();
        $worker->name = $workerDTO->getName();
        $worker->email = $workerDTO->getEmail();
        $worker->password = $workerDTO->getPassword();
        $worker->restaurant_id = $workerDTO->getRestaurantId();
        $worker->save();

        return $worker;
    }

    public function update(int $workerId, RestaurantWorkerDTO $workerDTO): ?RestaurantWorker
    {
        $worker = $this->getById($workerId);

        $worker->name = $workerDTO->getName();
        $worker->email = $workerDTO->getEmail();
        $worker->password = $workerDTO->getPassword();
        $worker->restaurant_id = $workerDTO->getRestaurantId();
        $worker->save();

        return $worker;
    }

    public function getByRestaurant(int $restaurantId): LengthAwarePaginator
    {
        return RestaurantWorker::query()->where('restaurant_id', $restaurantId)->paginate(15);
    }

    public function getOrdersList(int $workerId): LengthAwarePaginator
    {
        $worker = RestaurantWorker::query()->find($workerId);


        return Order::query()->where('restaurant_id', $worker->restaurant_id)->whereNull('restaurant_worker_id')->paginate(15);
    }


}
