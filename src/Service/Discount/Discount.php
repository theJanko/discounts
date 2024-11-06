<?php

namespace App\Service\Discount;

use App\Contracts\ProductInterface;

abstract class Discount
{
    public function __construct(
        public ?string $productCode
    ) {}

    abstract public function apply(array $products): float;

    public function isApplicable(ProductInterface $product): bool
    {
        return null === $this->productCode || $this->productCode === $product->getCode();
    }
}
