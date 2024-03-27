<?php

namespace App\DTO\Dish;

class CreateDishDTO
{
    private string $name;
    private string $descriptions;
    private float $price;
    private string $category;


    /**
     * @param string $name
     * @param string $descriptions
     * @param float $price
     * @param string $category
     */
    public function __construct(string $name, string $descriptions, float $price, string $category)
    {
        $this->name = $name;
        $this->descriptions = $descriptions;
        $this->price = $price;
        $this->category = $category;

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

    public function getCategory(): string
    {
        return $this->category;
    }

        public static function fromArray(array $date): static
        {
            return new static(
                name: $date['name'],
                descriptions: $date['descriptions'],
                price: $date['price'],
                category: $date['category'],
            );
        }

}
