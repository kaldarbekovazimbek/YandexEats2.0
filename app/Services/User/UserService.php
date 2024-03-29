<?php

namespace App\Services\User;

use App\DTO\User\RegistrationUserDTO;
use App\Exceptions\ExistsObjectException;
use App\Exceptions\NotFoundException;
use App\Interfaces\IUserRepository;
use App\Models\User;

class UserService
{

    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws NotFoundException
     */
    public function getUsers()
    {
        $users = $this->userRepository->index();

        if ($users === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $users;
    }

    /**
     * @throws NotFoundException
     */
    public function getUserById(int $userId): ?User
    {
        $user = $this->userRepository->getById($userId);

        if ($user === null) {
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }
        return $user;
    }

    /**
     * @throws ExistsObjectException
     */
    public function create(RegistrationUserDTO $userDTO): User
    {
        $existingUser = $this->userRepository->getByEmail($userDTO->getEmail());

        if ($existingUser !== null) {
            throw new ExistsObjectException(__('messages.object_with_email_exists'), 409);
        }

        return $this->userRepository->create($userDTO);
    }

    /**
     * @throws ExistsObjectException
     */
    public function update(int $userId, RegistrationUserDTO $userDTO): ?User
    {
        $existingUser = $this->userRepository->getByEmail($userDTO->getEmail());

        if ($existingUser !== null && $existingUser->id !== $userId) {
            throw new ExistsObjectException(__('messages.object_with_email_exists'), 409);
        }

        return $this->userRepository->update($userId, $userDTO);
    }

    /**
     * @throws NotFoundException
     */
    public function delete(int $userId): ?User
    {
        $user = $this->getUserById($userId);
        if ($user === null){
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        return $user;
    }

    public function getOrders(int $userId)
    {
        $orders = $this->userRepository->getOrders($userId);
        if ($orders===null){
            throw new NotFoundException(__('messages.object_not_found'), 404);
        }

        return $orders;
    }
}
