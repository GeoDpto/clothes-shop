<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use App\Service\Product\ProductPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     */
    public function showCart(): Response
    {
        return $this->render('cart/cart.html.twig', [
            'cart' => $this->cartService->getCart(),
        ]);
    }

    /**
     * @return Response
     */
    public function miniCart(): Response
    {
        return $this->render('cart/_minicart.html.twig', [
            'cart' => $this->cartService->getCart(),
        ]);
    }

    /**
     * @param ProductPresentationServiceInterface $presentationService
     * @param Request $request
     * @return Response
     */
    public function add(ProductPresentationServiceInterface $presentationService, Request $request): Response
    {
        $this->cartService->addProduct($presentationService->getById($request->query->get('product_id')));

        return $this->redirect($request->headers->get('referer'), 301);
    }
}
