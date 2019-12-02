<?php

declare(strict_types=1);

namespace App\Service\Checkout;

interface OrderServiceInterface
{
    /**
     * @param array $data
     * @param string $mail
     * @param array $products
     */
    public function addOrder(array $data, string $mail, array $products): void;
}
