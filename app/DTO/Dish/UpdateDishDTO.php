<?php

namespace App\DTO\Dish;

class UpdateDishDTO
{
    private string $name;
    private string $descriptions;
    private float $price;



    /**
     * @param string $name
     * @param string $descriptions
     * @param float $price
     */
    public function __construct(string $name, string $descriptions, float $price)
    {
        $this->name = $name;
        $this->descriptions = $descriptions;
        $this->price = $price;

    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescriptions(): string
    {
        return $this->descriptions;
    }

    public function getPrice(): float
    {
        return $this->price;
    }



    public static function fromArray(array $date): static
    {
        return new static(
            name: $date['name'],
            descriptions: $date['description'],
            price: $date['price'],


        );
    }

}
