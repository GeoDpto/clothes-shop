<?php

declare(strict_types=1);

namespace App\Exception;

class CartIsEmptyException extends \Exception
{
    public function __construct($code = 0, \Throwable $previous = null)
    {
        parent::__construct(\sprintf('Cart is empty. Add products in your cart.'), $code, $previous);
    }
}