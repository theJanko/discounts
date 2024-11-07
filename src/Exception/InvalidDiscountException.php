<?php

namespace App\Exception;

class InvalidDiscountException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Invalid Discount provided');
    }
}
