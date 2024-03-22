<?php

namespace App\DTO\Dish;

class CreateDishDTO
{
    private string $name;
    private string $descriptions;
    private float $price;
    private string $category;
    private int $restaurant_id;

    /**
     * @param string $name
     * @param string $descriptions
     * @param float $price
     * @param string $category
     * @param int $restaurant_id
     */
    public function __construct(string $name, string $descriptions, float $price, string $category, int $restaurant_id)
    {
        $this->name = $name;
        $this->descriptions = $descriptions;
        $this->price = $price;
        $this->category = $category;
        $this->restaurant_id = $restaurant_id;
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

    public function getRestaurantId(): int
    {
        return $this->restaurant_id;
    }

        public static function fromArray(array $date): static
        {
            return new static(
                name: $date['name'],
                descriptions: $date['descriptions'],
                price: $date['price'],
                category: $date['category'],
                restaurant_id: $date['restaurant_id'],
            );
        }

}
