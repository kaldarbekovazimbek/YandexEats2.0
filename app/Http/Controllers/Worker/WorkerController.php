<?php

namespace App\Http\Controllers\Worker;

use App\DTO\Worker\RegistrationWorkerDTO;
use App\Exceptions\ExistsObjectException;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\RestaurantWorkerRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\WorkerCollection;
use App\Http\Resources\WorkerResource;
use App\Services\RestaurantWorkerService;
use Illuminate\Http\JsonResponse;

class WorkerController extends Controller
{
    public function __construct(
        protected RestaurantWorkerService $workerService
    )
    {
    }

    public function profile(): ?WorkerResource
    {
        $worker = $this->workerService->profile();

        return new WorkerResource($worker);
    }

}
