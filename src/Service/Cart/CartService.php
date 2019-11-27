<?php

declare(strict_types=1);

namespace App\Service\Cart;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var int
     */
    protected $taxRate = 20;

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

        $entity = [
            'product' => $product,
            'quantity' => $quantity,
            'price' => $product->getPrice(),
        ];

        $cart[$product->getId()] = $product;

        $this->session->set('cart', $cart);
    }

    /**
     * @return SessionInterface
     */
    public function getCartProducts(): array
    {
        return $this->session->get('cart');
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        $total = 0;

        foreach ($this->session->get('cart') as $product) {
            $total += $product['product']->getPrice() * $product['quantity'];
        }
    }

    /**
     * Sets empty a cart.
     */
    public function setEmptyCart(): void
    {
        $this->session->set('cart', []);
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return empty($this->session->get('cart'));
    }

    public function removeProduct(Product $product)
    {
        $cart = $this->session->get('cart');

        if ($this->getProduct($product->getId())) {
            unset($cart[$product->getId()]);

            $this->session->set('cart', $cart);
        }
    }

    /**
     * @param $id
     *
     * @return Product|null
     */
    public function getProduct($id): ?Product
    {
        $cart = $this->session->get('cart');

        if (array_key_exists($id, $cart)) {
            return $cart[$id]['meal'];
        }

        return null;
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        return $this->getTotalPrice() * $this->taxRate / 100;
    }

    /**
     * @return int
     */
    public function countProducts(): int
    {
        $cart = $this->session->get('cart');

        return count($cart);
    }
}
