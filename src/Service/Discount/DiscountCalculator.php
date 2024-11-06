<?php

namespace App\Service\Discount;

use App\Contracts\ProductInterface;

readonly class DiscountCalculator
{
    public function __construct(
        private array $discounts
    ) {}

    public function calculateTotal(array $products): float
    {
        $total = 0;

        /** @var ProductInterface $product */
        foreach ($products as $product) {
            $total += $product->getPrice()->getAmount() * $product->getQuantity();
        }

        $discountAmount = 0;

        /** @var Discount $discount */
        foreach ($this->discounts as $discount) {
            $discountAmount += $discount->apply($products);
        }

        return max(0, $total - $discountAmount);
    }
}
