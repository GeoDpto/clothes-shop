<?php

namespace App\Controller;

use App\Service\Category\CategoryServiceInterface;
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
     * @param CategoryServiceInterface $categoryService
     * @return Response
     */
    public function show(ProductPresentationService $presentationService, CategoryServiceInterface $categoryService): Response
    {
        return $this->render('products/products.html.twig', [
            'categories' => $categoryService->getCategories(),
            'products' => $presentationService->getPublished(),
        ]);
    }
}
