<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Entity\Customer;
use App\Entity\Order;

interface AdminOrderServiceInterface
{
    /**
     * @param int $id
     * @return Order
     */
    public function getById(int $id): Order;

    /**
     * @return iterable
     */
    public function getOrders(): iterable;

    /**
     * @param int $id
     */
    public function delete(int $id): void;
}
