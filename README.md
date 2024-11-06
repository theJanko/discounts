### Discount Calculator

### Features
- **Fixed Discount**: -X \<currency\>
- **Percentage Discount**: -X%
- **Volume Discount**: -X \<currency\> if there are at least N products bought together

### Requirements
- PHP 8.3 or later
- Composer

### Installation
```bash
git clone xxx
cd discounts
composer install
```

### Instalation of php-cs-fixer
```bash
cd discounts/tools
composer install
```

### Run the tests
```bash
php bin/phpunit tests
```

### Usage
The main component of this app is the DiscountCalculator class. It is responsible for calculating the total value of the products after applying the discounts.

### Example
```php
use App\DiscountCalculator;
use App\Discount\FixedDiscount;
use App\Discount\PercentageDiscount;
use App\Discount\VolumeDiscount;
use App\Product;

$discounts = [
    new FixedDiscount(10),
    new PercentageDiscount(10),
    new VolumeDiscount(100),
];

$products = [
    new Product('product1', 100, 'PLN', 1),
    new Product('product2', 100, 'PLN', 1),
    new Product('product3', 100, 'PLN', 1),
    new Product('product4', 100, 'PLN', 1),
    new Product('product5', 100, 'PLN', 1),
    new Product('product6', 100, 'PLN', 1),
    new Product('product7', 100, 'PLN', 1),
    new Product('product8', 100, 'PLN', 1),
    new Product('product9', 100, 'PLN', 1),
    new Product('product10', 100, 'PLN', 1),
];

$calculator = new DiscountCalculator($discounts);
$total = $calculator->calculateTotal($products);

echo $total; // 800
```