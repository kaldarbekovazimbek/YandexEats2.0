<?php

namespace App\Http\Controllers;

use App\DTO\Dish\CreateDishDTO;
use App\DTO\Dish\UpdateDishDTO;
use App\Exceptions\NotFoundException;
use App\Http\Requests\DishRequest;
use App\Http\Resources\DishCollection;
use App\Http\Resources\DishResource;
use App\Services\DishService;
use Illuminate\Http\JsonResponse;

class DishController extends Controller
{
    public function __construct(protected DishService $dishService)
    {
    }

    public function index(int $restaurantId): DishCollection
    {
        $dishes = $this->dishService->index($restaurantId);
        return new DishCollection($dishes);
    }

    /**
     * @throws NotFoundException
     */
    public function show(int $dishId): DishResource
    {
        $dish = $this->dishService->getById($dishId);

        return new DishResource($dish);
    }

    public function store(DishRequest $request): DishResource
    {
        $validData = $request->validated();

        $dish = $this->dishService->createDish(CreateDishDTO::fromArray($validData));

        return new DishResource($dish);
    }

    /**
     * @throws NotFoundException
     */
    public function update(int $dishId, DishRequest $request): DishResource
    {
        $validData = $request->validated();

        $dish = $this->dishService->updateDish($dishId, UpdateDishDTO::fromArray($validData));

        return new DishResource($dish);
    }

    /**
     * @throws NotFoundException
     */
    public function delete(int $dishId): JsonResponse
    {
        $this->dishService->delete($dishId);
        return response()->json([
            'message' => __('messages.object_deleted')
        ]);
    }

}
