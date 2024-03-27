<?php

namespace App\Services;

use App\DTO\Worker\RegistrationWorkerDTO;
use App\Exceptions\ExistsObjectException;
use App\Exceptions\NotFoundException;
use App\Interfaces\IWorkerRepository;
use App\Models\RestaurantWorker;


class RestaurantWorkerService
{

    protected IWorkerRepository $restaurantWorkerRepository;

    public function __construct(IWorkerRepository $workerRepository)
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

    public function profile(): ?RestaurantWorker
    {
        return $this->restaurantWorkerRepository->profile();
    }

    /**
     * @throws ExistsObjectException
     */
    public function create(RegistrationWorkerDTO $workerDTO): RestaurantWorker
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
    public function update(int $workerId, RegistrationWorkerDTO $workerDTO): RestaurantWorker
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
    public function getRestaurantWorkers(int $restaurantId)
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
