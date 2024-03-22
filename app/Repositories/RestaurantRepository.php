<?php

namespace App\Repositories;

use App\DTO\Restaurant\RestaurantDTO;
use App\Interfaces\IRestaurantRepository;
use App\Models\Restaurant;

class RestaurantRepository implements IRestaurantRepository
{

    public function index()
    {
        /**
         * @var Restaurant $restaurants
         */
        $restaurants = Restaurant::query()->paginate(15);

        return $restaurants;
    }

    public function getById(int $restaurantId): ?Restaurant
    {
        /**
         * @var Restaurant
         */
        return Restaurant::query()->find($restaurantId);
    }

    public function create(RestaurantDTO $restaurantDTO): Restaurant
    {
        $restaurant = new Restaurant();

        $restaurant->name = $restaurantDTO->getName();
        $restaurant->address = $restaurantDTO->getAddress();
        $restaurant->phone = $restaurantDTO->getPhone();
        $restaurant->save();

        return $restaurant;
    }

    public function update(int $restaurantId, RestaurantDTO $restaurantDTO): ?Restaurant
    {
        $restaurant = $this->getById($restaurantId);

        $restaurant->name = $restaurantDTO->getName();
        $restaurant->address = $restaurantDTO->getAddress();
        $restaurant->phone = $restaurantDTO->getPhone();
        $restaurant->save();

        return $restaurant;
    }

    public function delete(int $restaurantId): ?Restaurant
    {
        return $this->getById($restaurantId);
    }

}
