<?php

namespace App\Controller;

use App\Form\CheckoutType;
use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    /**
     * @Route("/checkout", name="checkout")
     * @param CartService $cartService
     * @param Request $request
     * @return Response
     */
    public function checkout(CartService $cartService, Request $request): Response
    {
        $form = $this->createForm(CheckoutType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd($form->getData());
        }

        return $this->render('checkout/checkout.html.twig', [
            'totalPrice' => $cartService->getTotalPrice(),
            'products' => $cartService->getCartProducts(),
            'checkout' => $form->createView(),
        ]);
    }
}
