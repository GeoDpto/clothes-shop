<?php

namespace App\Controller;

use App\Exception\CartIsEmptyException;
use App\Form\CheckoutType;
use App\Service\Cart\CartService;
use App\Service\Checkout\OrderServiceInterface;
use App\Service\Customer\CustomerServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckoutController extends AbstractController
{
    /**
     * @Route("/checkout", name="checkout")
     *
     * @param CartService $cartService
     * @param Request $request
     * @param CustomerServiceInterface $customerService
     * @param OrderServiceInterface $checkoutService
     * @return Response
     * @throws CartIsEmptyException
     */
    public function checkout(CartService $cartService,
                             Request $request,
                             CustomerServiceInterface $customerService,
                             OrderServiceInterface $checkoutService): Response
    {
        $products = $cartService->getCartProducts();
        $form = $this->createForm(CheckoutType::class);
        $form->handleRequest($request);

        if ($cartService->isEmpty()) {
            throw new CartIsEmptyException();
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();
            $customerService->addCustomer($customer);
            $checkoutService->addOrder($products, $customer->getEmail(), $products);
            $cartService->setEmptyCart();

            return $this->render('checkout/success.html.twig', [
            ]);
        }

        return $this->render('checkout/checkout.html.twig', [
            'totalPrice' => $cartService->getTotalPrice(),
            'products' => $products,
            'checkout' => $form->createView(),
        ]);
    }
}
