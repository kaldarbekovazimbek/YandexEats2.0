<?php

namespace App\Http\Controllers;

use App\DTO\User\UserDTO;
use App\Exceptions\ExistsObjectException;
use App\Exceptions\NotFoundException;
use App\Http\Requests\UserRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws NotFoundException
     */
    public function index(): UserCollection
    {
        $users = $this->userService->getUsers();

        return new UserCollection($users);
    }

    /**
     * @throws ExistsObjectException
     */
    public function store(UserRequest $request): UserResource
    {
        $validData = $request->validated();

        $user = $this->userService->create(UserDTO::fromArray($validData));

        return new UserResource($user);
    }

    /**
     * @throws NotFoundException
     */
    public function show(int $userId): UserResource
    {
        $user = $this->userService->getUserById($userId);

        return new UserResource($user);
    }

    /**
     * @throws ExistsObjectException
     */
    public function update(int $userId, UserRequest $request): UserResource
    {
        $validData = $request->validated();

        $user = $this->userService->update($userId, UserDTO::fromArray($validData));

        return new UserResource($user);
    }

    /**
     * @throws NotFoundException
     */
    public function destroy(int $userId): JsonResponse
    {
        $this->userService->delete($userId)->delete();

        return response()->json([
            'message' => __('messages.object_deleted')
        ]);
    }

    public function getOrders($userId)
    {
        $orders = $this->userService->getOrders($userId);

        return new OrderCollection($orders);
    }
}
