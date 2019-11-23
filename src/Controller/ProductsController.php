<?php

namespace App\Controller;

use App\Service\Product\ProductPresentationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     *
     * @param ProductPresentationService $presentationService
     * @return Response
     */
    public function show(ProductPresentationService $presentationService): Response
    {
        return $this->render('products/products.html.twig', [
            'products' => $presentationService->getPublished(),
        ]);
    }
}
