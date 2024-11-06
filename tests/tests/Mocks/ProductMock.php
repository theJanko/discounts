<?php

namespace tests\Mocks;

use App\Contracts\PriceInterface;
use App\Contracts\ProductInterface;

class ProductMock implements ProductInterface
{
    public function __construct(
        public string $code,
        public PriceInterface $price,
        public int $quantity
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }

    public function getPrice(): PriceInterface
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
