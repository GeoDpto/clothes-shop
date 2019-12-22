<?php

declare(strict_types=1);

namespace App\Collection;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartCollecton implements \IteratorAggregate
{
    private $cart;

    public function __construct(SessionInterface $session)
    {
        $this->cart = $session->get('cart');
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return !empty($cart);
    }

    /**
     * @return int
     */
    public function countProducts(): int
    {
        return count($this->cart);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): iterable
    {
        return new \ArrayIterator($this->cart);
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        $total = 0;

        foreach ($this->cart as $product) {
            $total += $product->getPrice();
        }

        return $total;
    }
}
