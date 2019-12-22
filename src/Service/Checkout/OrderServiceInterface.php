<?php

declare(strict_types=1);

namespace App\Service\Checkout;

use App\Collection\CartCollecton;

interface OrderServiceInterface
{
    /**
     * @param string $mail
     * @param CartCollecton $products
     */
    public function addOrder(string $mail, CartCollecton $products): void;
}
