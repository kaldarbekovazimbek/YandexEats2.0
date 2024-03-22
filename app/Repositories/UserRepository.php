<?php

namespace App\Repositories;

use App\DTO\User\UserDTO;
use App\Interfaces\IUserRepository;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;

class   UserRepository implements IUserRepository
{

    public function index(): Paginator
    {
        return User::query()->simplePaginate(15);
    }

    public function getById(int $userId): ?User
    {
        /**
         * @var User
         */
        return User::query()->find($userId);
    }

    public function getByEmail(string $userEmail): ?User
    {
        /**
         * @var User
         */
        return User::query()->where('email', $userEmail)->first();
    }

    public function create(UserDTO $userDTO): User
    {
        $user = new User();

        $user->name = $userDTO->getName();
        $user->email = $userDTO->getEmail();
        $user->password = bcrypt($userDTO->getPassword());
        $user->save();

        return $user;
    }

    public function update(int $userId, UserDTO $userDTO): ?User
    {
        $user = $this->getById($userId);

        $user->name = $userDTO->getName();
        $user->email = $userDTO->getEmail();
        $user->password = bcrypt($userDTO->getPassword());
        $user->save();

        return $user;
    }

    public function getOrders($userId)
    {
       $orders = Order::query()->where('user_id', $userId);

       return $orders;
    }
}
