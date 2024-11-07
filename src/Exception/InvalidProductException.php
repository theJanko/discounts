<?php

namespace App\Exception;

class InvalidProductException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('Invalid product provided');
    }
}
