<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use App\Service\Category\CategoryServiceInterface;
use App\Service\Product\ProductPresentationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     * @param ProductPresentationService $presentationService
     * @param CategoryServiceInterface $categoryService
     * @param Request $request
     * @param CartService $cartService
     * @return Response
     */
    public function show(ProductPresentationService $presentationService,
                         CategoryServiceInterface $categoryService,
                         Request $request,
                         CartService $cartService): Response
    {
        if ($request->isMethod('POST')) {
            $cartService->addProduct($presentationService->getById($request->request->get('product_id')));
        }

        $products = $presentationService->getPaginatedProducts($request->query->getInt('page', 1));

        return $this->render('products/products.html.twig', [
            'categories' => $categoryService->getAll(),
            'products' => $products,
        ]);
    }
}
