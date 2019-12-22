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
        $cart = $cartService->getCart();
        $form = $this->createForm(CheckoutType::class);
        $form->handleRequest($request);

        if (empty($cart)) {

        }

        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();
            $customerService->addCustomer($customer);
            $checkoutService->addOrder($customer->getEmail(), $cart);
            $cartService->EmptyCart();

            return $this->render('checkout/success.html.twig', [
            ]);
        }

        return $this->render('checkout/checkout.html.twig', [
            'cart' => $cart,
            'checkout' => $form->createView(),
        ]);
    }
}
