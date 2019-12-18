<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @var CartService
     */
    protected $cartService;

    /**
     * CartController constructor.
     * @param CartService $cartService
     */
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @Route("/cart", name="cart")
     *
     */
    public function showCart(): Response
    {
        return $this->render('cart/cart.html.twig', [
            'products' => $this->cartService->getCartProducts(),
            'totalPrice' => $this->cartService->getTotalPrice(),
        ]);
    }

    public function miniCart(): Response
    {
        return $this->render('cart/_minicart.html.twig', [
            'countProducts' => $this->cartService->countProducts(),
        ]);
    }
}
