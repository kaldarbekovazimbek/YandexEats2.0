<?php

namespace App\Repositories;

use App\DTO\Dish\CreateDishDTO;
use App\DTO\Dish\UpdateDishDTO;
use App\Interfaces\IDishRepository;
use App\Models\Dish;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DishRepository implements IDishRepository
{

    public function index(int $restaurantId): LengthAwarePaginator
    {
        return Dish::query()->where('restaurant_id', $restaurantId)->paginate(15);
    }


    public function createDish(CreateDishDTO $createDishDTO): Dish
    {
        $dish = new Dish();

        $dish->name = $createDishDTO->getName();
        $dish->descriptions = $createDishDTO->getDescriptions();
        $dish->price = $createDishDTO->getPrice();
        $dish->category = $createDishDTO->getCategory();
        $dish->restaurant_id = $createDishDTO->getRestaurantId();
        $dish->save();

        return $dish;
    }

    public function updateDish(int $dishId, UpdateDishDTO $updateDishDTO): ?Dish
    {
        /**
         * @var Dish $dish
         */
        $dish = Dish::query()->find($dishId);

        $dish->name = $updateDishDTO->getName();
        $dish->descriptions = $updateDishDTO->getDescriptions();
        $dish->price = $updateDishDTO->getPrice();
        $dish->category = $updateDishDTO->getCategory();
        $dish->save();

        return $dish;
    }

    public function deleteDish(int $dishId)
    {
        return Dish::query()->find($dishId)->delete();

    }

    public function getById(int $dishId)
    {
        return Dish::query()->find($dishId);
    }
}
