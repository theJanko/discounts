<?php

namespace App\Service\Discount;

use App\Contracts\ProductInterface;

final class VolumeDiscount extends Discount
{
    public function __construct(
        public int $discountValue,
        public int $minQuantity,
        public ?string $productCode = null
    ) {
        parent::__construct($productCode);
    }

    public function apply(array $products): float
    {
        $totalDiscount = 0;
        /** @var ProductInterface $product */
        foreach ($products as $product) {
            if ($this->isApplicable($product) && $product->getQuantity() >= $this->minQuantity) {
                $totalDiscount += $this->discountValue;
            }
        }

        return $totalDiscount;
    }
}
