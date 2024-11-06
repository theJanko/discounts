# Discount Calculator

Imagine you are implementing an e-commerce system. You are required to write a discount calculator.

The calculator should:

- Accept a list of available discounts as a constructor argument.
- Expose a public method to apply discounts to a given list of products and return the total value of the products.

## Discount Types

The calculator must support the following types of discounts:

| Type               | Rule                                       | Example                                   |
|--------------------|--------------------------------------------|-------------------------------------------|
| Fixed Discount     | -X \<currency\>                            | -100 PLN                                  |
| Percentage Discount| -X%                                        | -10%                                      |
| Volume Discount    | -X \<currency\> if there are at least N products bought together | -100 EUR if there are at least 10 products bought together |
Additionally, discounts might be applicable only to specific products.

## Product API

You can assume that the product class has the following API:

```php
interface PriceInterface
{
    public function getAmount(): int;
    public function getCurrency(): string;
}

interface ProductInterface
{
    public function getCode(): string;
    public function getPrice(): PriceInterface;
    public function getQuantity(): int;
}
```