<?php

declare(strict_types=1);

namespace App\Service\Order;

use App\Entity\Order;
use App\Repository\Order\OrderRepository;

class AdminOrderService implements AdminOrderServiceInterface
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * AdminOrderService constructor.
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): Order
    {
        return $this->orderRepository->getById($id);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrders(): iterable
    {
        return $this->orderRepository->getOrders();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(int $id): void
    {
        $this->orderRepository->delete($id);
    }
}
