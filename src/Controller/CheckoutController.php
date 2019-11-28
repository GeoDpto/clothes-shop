<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    /**
     * @Route("/checkout", name="checkout")
     * @param CartService $cartService
     * @return Response
     */
    public function checkout(CartService $cartService): Response
    {
        return $this->render('checkout/checkout.html.twig', [
            'totalPrice' => $cartService->getTotalPrice(),
            'products' => $cartService->getCartProducts(),
        ]);
    }
}
