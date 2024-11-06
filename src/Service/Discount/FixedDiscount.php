<?php

namespace App\Service\Discount;

use App\Contracts\ProductInterface;

final class FixedDiscount extends Discount
{
    public function __construct(
        public int $discountValue,
        public ?string $productCode = null
    ) {
        parent::__construct($productCode);
    }

    public function apply(array $products): float
    {
        $totalDiscount = 0;
        /** @var ProductInterface $product */
        foreach ($products as $product) {
            if ($this->isApplicable($product)) {
                $totalDiscount += $this->discountValue * $product->getQuantity();
            }
        }

        return $totalDiscount;
    }
}
