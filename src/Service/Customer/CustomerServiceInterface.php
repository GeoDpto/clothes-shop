<?php

declare(strict_types=1);

namespace App\Service\Customer;

use App\Entity\Customer;

interface CustomerServiceInterface
{
    /**
     * @param Customer $customer
     */
    public function addCustomer(Customer $customer): void;
}
