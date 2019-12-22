<?php

declare(strict_types=1);

namespace App\Service\Cart;

use App\Collection\CartCollecton;
use App\Entity\Product;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * CartService constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;

        if (null === $this->session->get('cart')) {
            $this->session->set('cart', []);
        }
    }

    /**
     * Adds product in cart.
     * @param Product $product
     * @param int $quantity
     */
    public function addProduct(Product $product, int $quantity = 1): void
    {
        $cart = $this->session->get('cart');

        $cart[$product->getId()] = $product;

        $this->session->set('cart', $cart);
    }

    /**
     * @return array
     */
    public function getCart(): CartCollecton
    {
        return new CartCollecton($this->session);
    }


    /**
     * Sets empty a cart.
     */
    public function EmptyCart(): void
    {
        $this->session->set('cart', []);
    }

}
