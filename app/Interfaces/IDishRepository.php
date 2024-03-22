<?php

namespace App\Interfaces;

use App\DTO\Dish\CreateDishDTO;
use App\DTO\Dish\UpdateDishDTO;

interface IDishRepository
{
    public function index();

    public function getById(int $dishId);
    public function getByRestaurants(int $restaurantId);

    public function createDish(CreateDishDTO $createDishDTO);

    public function updateDish(int $dishId, UpdateDishDTO $updateDishDTO);

    public function deleteDish(int $dishId);

}
