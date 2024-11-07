<?php

namespace Service\Discount;

use App\Contracts\PriceInterface;
use App\Contracts\ProductInterface;
use PHPUnit\Framework\TestCase;

abstract class DiscountTest extends TestCase
{
    protected function createProductMock(
        string $code,
        int $amount,
        string $currency,
        int $quantity
    ): ProductInterface {
        $price = $this->createMock(PriceInterface::class);
        $price->method('getAmount')->willReturn($amount);
        $price->method('getCurrency')->willReturn($currency);

        $product = $this->createMock(ProductInterface::class);
        $product->method('getCode')->willReturn($code);
        $product->method('getPrice')->willReturn($price);
        $product->method('getQuantity')->willReturn($quantity);

        return $product;
    }
}
