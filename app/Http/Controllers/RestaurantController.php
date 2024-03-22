<?php

namespace App\Http\Controllers;

use App\DTO\Restaurant\RestaurantDTO;
use App\Exceptions\NotFoundException;
use App\Http\Requests\RestaurantRequest;
use App\Http\Resources\RestaurantCollection;
use App\Http\Resources\RestaurantResource;
use App\Services\RestaurantService;
use Illuminate\Http\JsonResponse;

class RestaurantController extends Controller
{
    private RestaurantService $restaurantService;

    public function __construct(RestaurantService $restaurantService)
    {
        $this->restaurantService = $restaurantService;
    }

    /**
     * @throws NotFoundException
     */
    public function index(): RestaurantCollection
    {
        $restaurants = $this->restaurantService->getRestaurants();

        return new RestaurantCollection($restaurants);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(RestaurantRequest $request): RestaurantResource
    {
        $validData = $request->validated();

        $restaurant = $this->restaurantService->create(RestaurantDTO::fromArray($validData));

        return new RestaurantResource($restaurant);
    }

    /**
     * Display the specified resource.
     * @throws NotFoundException
     */
    public function show(int $restaurantId): RestaurantResource
    {
        $restaurant = $this->restaurantService->getById($restaurantId);

        return new RestaurantResource($restaurant);
    }


    /**
     * Update the specified resource in storage.
     * @throws NotFoundException
     */
    public function update(int $restaurantId, RestaurantRequest $request): RestaurantResource
    {
        $validData = $request->validated();

        $restaurant = $this->restaurantService->update($restaurantId, RestaurantDTO::fromArray($validData));

        return new RestaurantResource($restaurant);
    }

    /**
     * Remove the specified resource from storage.
     * @throws NotFoundException
     */
    public function destroy(int $restaurantId): JsonResponse
    {
        $this->restaurantService->getById($restaurantId);

        return response()->json([
            'message' => __('messages.object_deleted')
        ]);
    }
}
