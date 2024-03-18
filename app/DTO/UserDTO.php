<?php

namespace App\DTO;


class UserDTO
{
    private string $name;
    private string $email;
    private string $password;

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

    public function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;

        $this->password = $password;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            name: $data['name'],
            email: $data['email'],
            password: $data['password'],
        );
    }
}
