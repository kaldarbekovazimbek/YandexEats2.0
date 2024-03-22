<?php

namespace App\Interfaces;

use App\DTO\User\UserDTO;
use App\Models\User;

interface IUserRepository
{
    public function index();

    public function getById(int $userId): ?User;

    public function getByEmail(string $userEmail): ?User;

    public function create(UserDTO $userDTO): User;

    public function update(int $userId, UserDTO $userDTO): ?User;

    public function getOrders(int $userId);

}
