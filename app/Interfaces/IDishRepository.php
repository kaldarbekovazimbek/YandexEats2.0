<?php

namespace App\Interfaces;

use App\DTO\Dish\CreateDishDTO;
use App\DTO\Dish\UpdateDishDTO;

interface IDishRepository
{
    public function index(int $restaurantId);

    public function getById(int $dishId);

    public function createDish(CreateDishDTO $createDishDTO);

    public function updateDish(int $dishId, UpdateDishDTO $updateDishDTO);

    public function deleteDish(int $dishId);

}
