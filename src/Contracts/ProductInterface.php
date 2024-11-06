<?php

namespace App\Contracts;

interface ProductInterface
{
    public function getCode(): string;

    public function getPrice(): PriceInterface;

    public function getQuantity(): int;
}
