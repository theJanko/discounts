<?php

namespace Service\Discount;

use App\Contracts\PriceInterface;
use App\Contracts\ProductInterface;
use App\Service\Discount\DiscountCalculator;
use App\Service\Discount\FixedDiscount;
use App\Service\Discount\PercentageDiscount;
use App\Service\Discount\VolumeDiscount;
use PHPUnit\Framework\TestCase;

class DiscountCalculatorTest extends TestCase
{
    public function testCalculatedDiscountAmountWithAllDiscounts()
    {
        $priceMock = $this->createMock(PriceInterface::class);
        $priceMock->method('getAmount')->willReturn(10000);
        $priceMock->method('getCurrency')->willReturn('PLN');

        $productMock = $this->createMock(ProductInterface::class);
        $productMock->method('getCode')->willReturn('TEST1');
        $productMock->method('getPrice')->willReturn($priceMock);
        $productMock->method('getQuantity')->willReturn(3);

        $discounts = [
            new PercentageDiscount(10), // 100
            new FixedDiscount(10), // 10
            new VolumeDiscount(100, 3), // 100
        ];

        $discount = 0.1 * 100 * 3 + 10 * 3 + 100;
        $totalPrice = 1000 * 3;

        $discountCalculator = new DiscountCalculator($discounts);
        $discountValue = $discountCalculator->calculateTotal([$productMock]);

        $this->assertEquals($totalPrice - $discount, $discountValue);
    }

    public function testCalculatedDiscountWithPercentageAndFixedDiscounts()
    {
        $priceMock = $this->createMock(PriceInterface::class);
        $priceMock->method('getAmount')->willReturn(10000);
        $priceMock->method('getCurrency')->willReturn('PLN');

        $product = $this->createMock(ProductInterface::class);
        $product->method('getCode')->willReturn('TEST1');
        $product->method('getPrice')->willReturn($priceMock);
        $product->method('getQuantity')->willReturn(3);

        $discounts = [
            new PercentageDiscount(10, 'TEST1'), // 100
            new FixedDiscount(10, 'TEST2'), // 10
        ];

        $totalPrice = 10000 * 3;

        $discountCalculator = new DiscountCalculator($discounts);
        $discountValue = $discountCalculator->calculateTotal([$product]);

        $this->assertEquals($totalPrice, $discountValue);
    }
}
