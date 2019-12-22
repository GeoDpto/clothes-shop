<?php

declare(strict_types=1);

namespace App\Service\Checkout;

use App\Collection\CartCollecton;
use App\Entity\Order;
use App\Repository\Order\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrderService implements OrderServiceInterface
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * OrderService constructor.
     * @param OrderRepository $orderRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(OrderRepository $orderRepository, EntityManagerInterface $em)
    {
        $this->orderRepository = $orderRepository;
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function addOrder(string $mail, CartCollecton $products): void
    {
        $customer = $this->em->getRepository('App:Customer')->findOneBy(['email' => $mail]);

        $order = new Order();

        $order->setCustomer($customer)
            ->setDate(new \DateTimeImmutable())
        ;

        foreach ($products as $checkoutProduct) {
            $product = $this->em->getRepository('App:Product')->findOneBy(['id' => $checkoutProduct->getId()]);
            $order->addProduct($product);
        }

        $this->orderRepository->addOrder($order);
    }
}
