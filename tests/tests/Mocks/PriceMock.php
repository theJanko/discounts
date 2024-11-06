<?php

namespace tests\Mocks;

use App\Contracts\PriceInterface;

class PriceMock implements PriceInterface
{
    public function __construct(
        public int $amount,
        public string $currency
    ) {}

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}
