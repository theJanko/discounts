<?php

namespace Service\Discount;

use App\Service\Discount\PercentageDiscount;

/**
 * @internal
 *
 * @coversNothing
 */
class PercentageDiscountTestTest extends DiscountTest
{
    public function testPercentageDiscountAppliesCorrectly()
    {
        $product = $this->createProductMock('TEST1', 1000, 'PLN', 1);

        $percentageDiscount = new PercentageDiscount(10);
        $discountValue = $percentageDiscount->apply([$product]);
        $this->assertEquals(100, $discountValue);
    }

    public function testPercentageDiscountAppliesCorrectlyToMultipleProducts()
    {
        $product1 = $this->createProductMock('TEST1', 1000, 'PLN', 1);
        $product2 = $this->createProductMock('TEST2', 1000, 'PLN', 2);

        $percentageDiscount = new PercentageDiscount(10);

        $discountValue = $percentageDiscount->apply([$product1, $product2]);
        $this->assertEquals(300, $discountValue);
    }
}
