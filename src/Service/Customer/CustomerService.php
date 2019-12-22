<?php

declare(strict_types=1);

namespace App\Service\Customer;

use App\Entity\Customer;
use App\Repository\Customer\CustomerRepository;

class CustomerService implements CustomerServiceInterface
{
    /**
     * @var CustomerRepository
     */
    private $customerRepository;

    /**
     * CustomerService constructor.
     * @param CustomerRepository $customerRepository
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Customer $customer): void
    {
        $this->customerRepository->save($customer);
    }
}
