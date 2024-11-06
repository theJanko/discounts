<?php

namespace App\Contracts;

interface PriceInterface
{
    public function getAmount(): int;

    public function getCurrency(): string;
}
