<?php

namespace Service\Discount;

use App\Contracts\PriceInterface;
use App\Contracts\ProductInterface;
use App\Service\Discount\PercentageDiscount;
use PHPUnit\Framework\TestCase;

class PercentageDiscountTest extends TestCase
{
    public function testPercentageDiscountAppliesCorrectly()
    {
        $priceMock = $this->createMock(PriceInterface::class);
        $priceMock->method('getAmount')->willReturn(1000);
        $priceMock->method('getCurrency')->willReturn('PLN');

        $productMock = $this->createMock(ProductInterface::class);
        $productMock->method('getCode')->willReturn('TEST1');
        $productMock->method('getPrice')->willReturn($priceMock);
        $productMock->method('getQuantity')->willReturn(1);

        $percentageDiscount = new PercentageDiscount(10);
        $discountValue = $percentageDiscount->apply([$productMock]);
        $this->assertEquals(100, $discountValue);
    }

    public function testPercentageDiscountAppliesCorrectlyToMultipleProducts()
    {
        $priceMock1 = $this->createMock(PriceInterface::class);
        $priceMock1->method('getAmount')->willReturn(1000);
        $priceMock1->method('getCurrency')->willReturn('PLN');

        $priceMock2 = $this->createMock(PriceInterface::class);
        $priceMock2->method('getAmount')->willReturn(1000);
        $priceMock2->method('getCurrency')->willReturn('PLN');

        $productMock1 = $this->createMock(ProductInterface::class);
        $productMock1->method('getCode')->willReturn('TEST1');
        $productMock1->method('getPrice')->willReturn($priceMock1);
        $productMock1->method('getQuantity')->willReturn(1);

        $productMock2 = $this->createMock(ProductInterface::class);
        $productMock2->method('getCode')->willReturn('TEST2');
        $productMock2->method('getPrice')->willReturn($priceMock2);
        $productMock2->method('getQuantity')->willReturn(2);

        $percentageDiscount = new PercentageDiscount(10);

        $discountValue = $percentageDiscount->apply([$productMock1, $productMock2]);
        $this->assertEquals(300, $discountValue);
    }
}
