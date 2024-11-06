<?php

namespace Service\Discount;

use App\Service\Discount\VolumeDiscount;

class VolumeDiscountTestTest extends DiscountTest
{
    public function testVolumeDiscountAppliesCorrectly()
    {
        $product = $this->createProductMock('TEST1', 1000, 'PLN', 3);

        $volumeDiscount = new VolumeDiscount(100, 3);

        $discountValue = $volumeDiscount->apply([$product]);
        $this->assertEquals(100, $discountValue);
    }

    public function testVolumeDiscountAppliesCorrectlyToMultipleProducts()
    {
        $product1 = $this->createProductMock('TEST1', 1000, 'PLN', 3);
        $product2 = $this->createProductMock('TEST2', 1000, 'PLN', 6);

        $volumeDiscount = new VolumeDiscount(100, 3);

        $discountValue = $volumeDiscount->apply([$product1, $product2]);
        $this->assertEquals(200, $discountValue);
    }
}
