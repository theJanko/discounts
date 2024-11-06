<?php

namespace Service\Discount;

use App\Contracts\PriceInterface;
use App\Contracts\ProductInterface;
use App\Service\Discount\FixedDiscount;
use PHPUnit\Framework\TestCase;

class FixedDiscountTest extends TestCase
{
    public function testFixedDiscountAppliesCorrectly()
    {
        $priceMock = $this->createMock(PriceInterface::class);
        $priceMock->method('getAmount')->willReturn(5000);

        $productMock = $this->createMock(ProductInterface::class);
        $productMock->method('getCode')->willReturn('TEST1');
        $productMock->method('getPrice')->willReturn($priceMock);
        $productMock->method('getQuantity')->willReturn(1);

        $fixedDiscount = new FixedDiscount(1000);

        $discountValue = $fixedDiscount->apply([$productMock]);
        $this->assertEquals(1000, $discountValue);
    }

    public function testFixedDiscountAppliesCorrectlyToMultipleProducts()
    {
        $priceMock1 = $this->createMock(PriceInterface::class);
        $priceMock1->method('getAmount')->willReturn(5000);
        $priceMock1->method('getCurrency')->willReturn('PLN');

        $priceMock2 = $this->createMock(PriceInterface::class);
        $priceMock2->method('getAmount')->willReturn(1000);
        $priceMock2->method('getCurrency')->willReturn('PLN');

        $product1 = $this->createMock(ProductInterface::class);
        $product1->method('getCode')->willReturn('TEST1');
        $product1->method('getPrice')->willReturn($priceMock1);
        $product1->method('getQuantity')->willReturn(1);

        $product2 = $this->createMock(ProductInterface::class);
        $product2->method('getCode')->willReturn('TEST2');
        $product2->method('getPrice')->willReturn($priceMock2);
        $product2->method('getQuantity')->willReturn(2);

        $fixedDiscount = new FixedDiscount(1000);

        $discountValue = $fixedDiscount->apply([$product1, $product2]);
        $this->assertEquals(3000, $discountValue);
    }
}
