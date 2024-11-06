<?php

namespace Service\Discount;

use App\Contracts\PriceInterface;
use App\Contracts\ProductInterface;
use App\Service\Discount\VolumeDiscount;
use PHPUnit\Framework\TestCase;

class VolumeDiscountTest extends TestCase
{
    public function testVolumeDiscountAppliesCorrectly()
    {
        $priceMock = $this->createMock(PriceInterface::class);
        $priceMock->method('getAmount')->willReturn(1000);
        $priceMock->method('getCurrency')->willReturn('PLN');

        $productMock = $this->createMock(ProductInterface::class);
        $productMock->method('getCode')->willReturn('TEST1');
        $productMock->method('getPrice')->willReturn($priceMock);
        $productMock->method('getQuantity')->willReturn(3);

        $volumeDiscount = new VolumeDiscount(100, 3);

        $discountValue = $volumeDiscount->apply([$productMock]);
        $this->assertEquals(100, $discountValue);
    }

    public function testVolumeDiscountAppliesCorrectlyToMultipleProducts()
    {
        $priceMock1 = $this->createMock(PriceInterface::class);
        $priceMock1->method('getAmount')->willReturn(1000);
        $priceMock1->method('getCurrency')->willReturn('PLN');

        $priceMock2 = $this->createMock(PriceInterface::class);
        $priceMock2->method('getAmount')->willReturn(1000);
        $priceMock2->method('getCurrency')->willReturn('PLN');

        $product1 = $this->createMock(ProductInterface::class);
        $product1->method('getCode')->willReturn('TEST1');
        $product1->method('getPrice')->willReturn($priceMock1);
        $product1->method('getQuantity')->willReturn(3);

        $product2 = $this->createMock(ProductInterface::class);
        $product2->method('getCode')->willReturn('TEST2');
        $product2->method('getPrice')->willReturn($priceMock2);
        $product2->method('getQuantity')->willReturn(6);

        $volumeDiscount = new VolumeDiscount(100, 3);

        $discountValue = $volumeDiscount->apply([$product1, $product2]);
        $this->assertEquals(200, $discountValue);
    }
}
