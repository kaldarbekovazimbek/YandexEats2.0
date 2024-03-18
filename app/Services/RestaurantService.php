<?php

namespace App\Services;

use App\DTO\RestaurantDTO;
use App\Exceptions\NotFoundException;
use App\Interfaces\IRestaurantRepository;
use App\Models\Restaurant;

class RestaurantService
{
    private IRestaurantRepository $restaurantRepository;

    /**
     * @param IRestaurantRepository $restaurantRepository
     */
    public function __construct(IRestaurantRepository $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    /**
     * @throws NotFoundException
     */
    public function getRestaurants()
    {
        $restaurants = $this->restaurantRepository->index();

        if ($restaurants === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $restaurants;
    }

    /**
     * @throws NotFoundException
     */
    public function getById(int $restaurantId)
    {
        $restaurant = $this->restaurantRepository->getById($restaurantId);

        if ($restaurant === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        return $restaurant;
    }

    public function create(RestaurantDTO $restaurantDTO)
    {
        return $this->restaurantRepository->create($restaurantDTO);
    }

    /**
     * @throws NotFoundException
     */
    public function update(int $restaurantId, RestaurantDTO $restaurantDTO)
    {
        $existingRestaurant = $this->restaurantRepository->getById($restaurantId);

        if ($existingRestaurant === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $this->restaurantRepository->update($restaurantId, $restaurantDTO);
    }

    /**
     * @throws NotFoundException
     */
    public function delete(int $restaurantId): ?Restaurant
    {
        $restaurant = $this->getById($restaurantId);
        if ($restaurant === null){
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        return $restaurant;
    }
}
