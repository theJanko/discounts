<?php

namespace App\Service\Discount;

use App\Contracts\ProductInterface;

final class PercentageDiscount extends Discount
{
    public function __construct(
        public int $discountPercentage,
        public ?string $productCode = null
    ) {
        parent::__construct($productCode);
    }
    public function apply(array $products): float
    {
        $discount = 0;
        /** @var ProductInterface $product */
        foreach ($products as $product) {
            if ($this->isApplicable($product)) {
                $discount += $product->getPrice()->getAmount() * $product->getQuantity() * $this->discountPercentage / 100;
            }
        }

        return $discount;
    }
}
