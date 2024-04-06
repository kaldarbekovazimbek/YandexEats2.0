<?php

namespace App\Services;

use App\DTO\Dish\CreateDishDTO;
use App\DTO\Dish\UpdateDishDTO;
use App\Exceptions\NotFoundException;
use App\Interfaces\IDishRepository;

class DishService
{
    public function __construct(protected IDishRepository $dishRepository)
    {
    }

    public function index(int $restaurantId)
    {
        return $this->dishRepository->index($restaurantId);
    }

    public function getDishesByCategory(int $restaurantId, string $category)
    {
        return $this->dishRepository->getDishesByCategory($restaurantId, $category);
    }

    /**
     * @throws NotFoundException
     */
    public function getById(int $dishId)
    {
        $dish = $this->dishRepository->getById($dishId);

        if ($dish === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        return $dish;
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
