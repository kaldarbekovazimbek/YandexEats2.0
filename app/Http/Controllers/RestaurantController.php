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

}
