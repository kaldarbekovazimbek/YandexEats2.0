<?php

namespace App\Services;

use App\DTO\Restaurant\RestaurantWorkerDTO;
use App\Exceptions\ExistsObjectException;
use App\Exceptions\NotFoundException;
use App\Interfaces\IRestaurantWorkerRepository;
use App\Models\RestaurantWorker;


class RestaurantWorkerService
{

    protected IRestaurantWorkerRepository $restaurantWorkerRepository;

    public function __construct(IRestaurantWorkerRepository $workerRepository)
    {
        $this->restaurantWorkerRepository = $workerRepository;
    }

    /**
     * @throws NotFoundException
     */
    public function getWorkers()
    {
        $worker = $this->restaurantWorkerRepository->index();

        if ($worker === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $worker;
    }

    /**
     * @throws NotFoundException
     */
    public function getWorkerById(int $workerId): ?RestaurantWorker
    {
        $worker = $this->restaurantWorkerRepository->getById($workerId);

        if ($worker === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $worker;
    }

    /**
     * @throws ExistsObjectException
     */
    public function create(RestaurantWorkerDTO $workerDTO): RestaurantWorker
    {
        $existingWorker = $this->restaurantWorkerRepository->getByEmail($workerDTO->getEmail());

        if ($existingWorker !== null) {
            throw new ExistsObjectException(__('messages.object_with_email_exists'), 409);
        }

        return $this->restaurantWorkerRepository->create($workerDTO);
    }

    /**
     * @throws ExistsObjectException
     */
    public function update(int $workerId, RestaurantWorkerDTO $workerDTO): RestaurantWorker
    {
        $existingWorker = $this->restaurantWorkerRepository->getByEmail($workerDTO->getEmail());

        if ($existingWorker !== null && $existingWorker->id !== $workerId) {
            throw new ExistsObjectException(__('messages.object_with_email_exists'), 409);
        }

        return $this->restaurantWorkerRepository->update($workerId, $workerDTO);
    }

    /**
     * @throws NotFoundException
     */
    public function delete(int $workerId): RestaurantWorker
    {
        $worker = $this->getWorkerById($workerId);
        if ($worker === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        return $worker;
    }


    /**
     * @throws NotFoundException
     */
    public function getByRestaurant(int $restaurantId)
    {
        $workers = $this->restaurantWorkerRepository->getByRestaurant($restaurantId);
        if ($workers === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $workers;
    }

    /**
     * @throws NotFoundException
     */
    public function getOrdersList(int $workerId)
    {
        $orders = $this->restaurantWorkerRepository->getOrdersList($workerId);
        if ($orders === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $orders;
    }

    /**
     * @throws NotFoundException
     */

}
