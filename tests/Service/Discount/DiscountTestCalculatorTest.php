<?php

namespace Service\Discount;

use App\Service\Discount\DiscountCalculator;
use App\Service\Discount\FixedDiscount;
use App\Service\Discount\PercentageDiscount;
use App\Service\Discount\VolumeDiscount;

/**
 * @internal
 *
 * @coversNothing
 */
class DiscountTestCalculatorTest extends DiscountTest
{
    public function testCalculatedDiscountAmountWithAllDiscounts()
    {
        $product = $this->createProductMock('TEST1', 1000, 'PLN', 3);

        $discounts = [
            new PercentageDiscount(10), // 100 * 3
            new FixedDiscount(10), // 10 * 3
            new VolumeDiscount(100, 3), // 100
        ];

        $discount = 0.1 * 1000 * 3 + 10 * 3 + 100;
        $totalPrice = 1000 * 3;
        $calculatedTotalPrice = $totalPrice - $discount;

        $discountCalculator = new DiscountCalculator($discounts);
        $discountValue = $discountCalculator->calculateTotal([$product]);

        $this->assertEquals($calculatedTotalPrice, $discountValue);
    }

    public function testCalculatedDiscountWithPercentageOnCorrectProductAndFixedDiscountsOnIncorrectProduct()
    {
        $product = $this->createProductMock('TEST1', 10000, 'PLN', 3);

        $discounts = [
            new PercentageDiscount(10, 'TEST1'), // 1000
            new FixedDiscount(10, 'TEST2'), // 10
        ];

        $totalPrice = 10000 * 3;
        $discountsValue = 0.1 * 10000 * 3;

        $discountCalculator = new DiscountCalculator($discounts);
        $discountValue = $discountCalculator->calculateTotal([$product]);

        $this->assertEquals($totalPrice - $discountsValue, $discountValue);
    }

    public function testCalculatedDiscountWithPercentageOnCorrectProductAndFixedDiscountsOnCorrectProduct()
    {
        $product = $this->createProductMock('TEST1', 10000, 'PLN', 3);

        $discounts = [
            new PercentageDiscount(10, 'TEST1'), // 1000
            new FixedDiscount(10, 'TEST1'), // 10
        ];

        $totalPrice = 10000 * 3;
        $discountsValue = 0.1 * 10000 * 3 + 10 * 3;

        $discountCalculator = new DiscountCalculator($discounts);
        $discountValue = $discountCalculator->calculateTotal([$product]);

        $this->assertEquals($totalPrice - $discountsValue, $discountValue);
    }

    public function testCalculatedDiscountWithoutDiscounts()
    {
        $product = $this->createProductMock('TEST1', 10000, 'PLN', 3);

        $discounts = [];

        $totalPrice = 10000 * 3;

        $discountCalculator = new DiscountCalculator($discounts);
        $discountValue = $discountCalculator->calculateTotal([$product]);

        $this->assertEquals($totalPrice, $discountValue);
    }

    public function testCalculatedDiscountWithEmptyProducts()
    {
        $discounts = [
            new PercentageDiscount(10, 'TEST1'),
            new FixedDiscount(10, 'TEST1'),
            new VolumeDiscount(100, 3),
        ];

        $discountCalculator = new DiscountCalculator($discounts);
        $discountValue = $discountCalculator->calculateTotal([]);

        $this->assertEquals(0, $discountValue);
    }

    public function testCalculatedDiscountWithoutMatchingProduct()
    {
        $product = $this->createProductMock('TEST1', 10000, 'PLN', 3);

        $discounts = [
            new PercentageDiscount(10, 'TEST2'),
            new FixedDiscount(10, 'TEST2'),
            new VolumeDiscount(100, 3, 'TEST2'),
        ];

        $totalPrice = 10000 * 3;

        $discountCalculator = new DiscountCalculator($discounts);
        $discountValue = $discountCalculator->calculateTotal([$product]);

        $this->assertEquals($totalPrice, $discountValue);
    }
}
