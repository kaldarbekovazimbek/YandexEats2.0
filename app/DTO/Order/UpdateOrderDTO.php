<?php

namespace App\DTO\Order;


class UpdateOrderDTO
{

    private string $status;


    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }


    public static function fromArray(array $data): static
    {
        return new static(
            status: $data['status'],
        );
    }

}
