<?php

namespace App\Http\Controllers;

use App\DTO\RestaurantWorkerDTO;
use App\Exceptions\ExistsObjectException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\RestaurantWorkerRequest;
use App\Http\Resources\RestaurantWorkerCollection;
use App\Http\Resources\RestaurantWorkerResource;
use App\Services\RestaurantWorkerService;
use Illuminate\Http\JsonResponse;

class RestaurantWorkerController extends Controller
{
    public function __construct(
        private RestaurantWorkerService $workerService
    )
    {
    }

    /**
     * @throws NotFoundException
     */
    public function index(): RestaurantWorkerCollection
    {
        $workers = $this->workerService->getWorkers();

        return new RestaurantWorkerCollection($workers);
    }

    /**
     * @throws ExistsObjectException
     */
    public function store(RestaurantWorkerRequest $request): RestaurantWorkerResource
    {
        $validData = $request->validated();

        $worker = $this->workerService->create(RestaurantWorkerDTO::fromArray($validData));

        return new RestaurantWorkerResource($worker);
    }

    /**
     * @throws NotFoundException
     */
    public function show(int $workerId): ?RestaurantWorkerResource
    {
        $worker = $this->workerService->getWorkerById($workerId);

        return new RestaurantWorkerResource($worker);
    }

    /**
     * @throws ExistsObjectException
     */
    public function update(int $workerId, RestaurantWorkerRequest $request): RestaurantWorkerResource
    {
        $validData = $request->validated();

        $worker = $this->workerService->update($workerId, RestaurantWorkerDTO::fromArray($validData));

        return new RestaurantWorkerResource($worker);
    }

    /**
     * @throws NotFoundException
     */
    public function destroy(int $workerId): JsonResponse
    {
        $worker = $this->workerService->delete($workerId);
        $worker->delete();

        return response()->json([
            'message' => __('messages.object_deleted')
        ]);
    }

    /**
     * @throws NotFoundException
     */
    public function getByRestaurant(int $restaurantId): RestaurantWorkerCollection
    {
        $workers = $this->workerService->getByRestaurant($restaurantId);

        return new RestaurantWorkerCollection($workers);
    }
}
