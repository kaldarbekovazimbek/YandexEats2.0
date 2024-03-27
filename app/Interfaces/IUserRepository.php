<?php

namespace App\Interfaces;

use App\DTO\User\RegistrationUserDTO;
use App\Models\User;

interface IUserRepository
{
    public function index();

    public function getById(int $userId): ?User;

    public function getByEmail(string $userEmail): ?User;

    public function create(RegistrationUserDTO $userDTO): User;



}
