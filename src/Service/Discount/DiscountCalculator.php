<?php

declare(strict_types=1);

namespace App\Service\Discount;

use App\Contracts\ProductInterface;
use App\Exception\InvalidDiscountException;
use App\Exception\InvalidProductException;

readonly class DiscountCalculator
{
    public function __construct(
        private array $discounts
    ) {}

    public function calculateTotal(array $products): float
    {
        $total = 0;

        foreach ($products as $product) {
            if (!$product instanceof ProductInterface) {
                throw new InvalidProductException();
            }

            $total += $product->getPrice()->getAmount() * $product->getQuantity();
        }

        $discountAmount = 0;

        /** @var Discount $discount */
        foreach ($this->discounts as $discount) {
            if (!$discount instanceof Discount) {
                throw new InvalidDiscountException();
            }

            $discountAmount += $discount->apply($products);
        }

        return max(0, $total - $discountAmount);
    }
}
