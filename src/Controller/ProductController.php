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
     *
     * @param int $id
     * @param ProductPresentationServiceInterface $productPresentationService
     * @param Request $request
     * @return Response
     */
    public function showProduct(int $id, ProductPresentationServiceInterface $productPresentationService,
                                Request $request): Response
    {
        if ($request->isMethod('POST')) {
            return $this->redirectToRoute('add_cart', [
                'product_id' => $request->request->get('product_id'),
            ]);
        }

        return $this->render('product/product.html.twig', [
            'product' => $productPresentationService->getById($id),
        ]);
    }
}
