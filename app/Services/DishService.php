<?php

namespace App\Services;

use App\DTO\Dish\CreateDishDTO;
use App\DTO\Dish\UpdateDishDTO;
use App\Exceptions\NotFoundException;
use App\Interfaces\IDishRepository;

class DishService
{
    public function __construct(private IDishRepository $dishRepository)
    {
    }

    public function index()
    {
        return $this->dishRepository->index();
    }

    /**
     * @throws NotFoundException
     */
    public function getByRestaurant(int $restaurantId)
    {
        $dishes = $this->dishRepository->getByRestaurants($restaurantId);
        if ($dishes === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $dishes;
    }

    public function createDish(CreateDishDTO $createDishDTO)
    {
        return $this->dishRepository->createDish($createDishDTO);
    }

    /**
     * @throws NotFoundException
     */
    public function updateDish(int $dishId, UpdateDishDTO $updateDishDTO)
    {
        $dish = $this->dishRepository->getById($dishId);
        if ($dish === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $this->dishRepository->updateDish($dishId, $updateDishDTO);
    }

    /**
     * @throws NotFoundException
     */
    public function delete(int $dishId)
    {
        $dish = $this->dishRepository->getById($dishId);
        if ($dish === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $dish;
    }
}
