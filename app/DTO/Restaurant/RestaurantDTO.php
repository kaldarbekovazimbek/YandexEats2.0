<?php

namespace App\DTO\Restaurant;

class RestaurantDTO
{
    private string $name;
    private string $address;
    private string $phone;

    /**
     * @param string $name
     * @param string $address
     * @param string $phone
     */
    public function __construct(string $name, string $address, string $phone)
    {
        $this->name = $name;
        $this->address = $address;
        $this->phone = $phone;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public static function fromArray(array $date): static
    {
        return new static(
            name: $date['name'],
            address: $date['address'],
            phone: $date['phone']
        );
    }
}
