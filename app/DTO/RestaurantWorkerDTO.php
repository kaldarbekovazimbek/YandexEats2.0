<?php

namespace App\DTO;


class RestaurantWorkerDTO
{
    private string $name;
    private string $email;
    private string $password;
    private int $restaurant_id;

    public function __construct(string $name, string $email, string $password, int $restaurant_id)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->restaurant_id = $restaurant_id;
    }

    public function getRestaurantId(): int
    {
        return $this->restaurant_id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
            restaurant_id: $data['restaurant_id']
        );
    }
}
