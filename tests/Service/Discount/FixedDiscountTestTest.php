<?php

namespace Service\Discount;

use App\Service\Discount\FixedDiscount;

class FixedDiscountTestTest extends DiscountTest
{
    public function testFixedDiscountAppliesCorrectly()
    {
        $product = $this->createProductMock('TEST1', 5000, 'PLN', 1);

        $fixedDiscount = new FixedDiscount(1000);

        $discountValue = $fixedDiscount->apply([$product]);
        $this->assertEquals(1000, $discountValue);
    }

    public function testFixedDiscountAppliesCorrectlyToMultipleProducts()
    {
        $product1 = $this->createProductMock('TEST1', 5000, 'PLN', 1);
        $product2 = $this->createProductMock('TEST2', 1000, 'PLN', 2);

        $fixedDiscount = new FixedDiscount(1000);

        $discountValue = $fixedDiscount->apply([$product1, $product2]);
        $this->assertEquals(3000, $discountValue);
    }
}
