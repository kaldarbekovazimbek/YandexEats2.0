<?php

namespace App\Interfaces;

use App\DTO\RestaurantDTO;

interface IRestaurantRepository
{
    public function index();

    public function getById(int $restaurantId);

    public function create(RestaurantDTO $restaurantDTO);

    public function update(int $restaurantId, RestaurantDTO $restaurantDTO);

    public function delete(int $restaurantId);
}
