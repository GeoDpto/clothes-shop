<?php

namespace App\Controller;

use App\Service\Cart\CartService;
use App\Service\Image\ImagePresentationServiceInterface;
use App\Service\Product\ProductPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products/product-{id}", name="product")
     * @param int $id
     * @param ProductPresentationServiceInterface $productPresentationService
     * @param ImagePresentationServiceInterface $imagePresentationService
     * @param Request $request
     * @param CartService $cartService
     * @return Response
     */
    public function showProduct(int $id, ProductPresentationServiceInterface $productPresentationService,
                                ImagePresentationServiceInterface $imagePresentationService,
                                Request $request,
                                CartService $cartService): Response
    {
        if ($request->isMethod('POST')) {
            $cartService->addProduct($productPresentationService->getById($request->request->get('product_id')));
        }

        return $this->render('product/product.html.twig', [
            'product' => $productPresentationService->getById($id),
            'images' => $imagePresentationService->getImagesByProductId($id),
        ]);
    }
}
