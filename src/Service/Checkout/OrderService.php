<?php

declare(strict_types=1);

namespace App\Service\Checkout;

use App\Repository\Order\OrderRepository;

class OrderService implements OrderServiceInterface
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * OrderService constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function addOrder(array $data, string $mail, array $products): void
    {
        $this->orderRepository->addOrder($data, $mail, $products);
    }
}
