<?php

namespace App\Controller;

use App\Service\Category\CategoryServiceInterface;
use App\Service\Product\ProductPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     *
     * @param ProductPresentationServiceInterface $productPresentation
     * @param CategoryServiceInterface $categoryService
     * @return Response
     */
    public function index(ProductPresentationServiceInterface $productPresentation, CategoryServiceInterface $categoryService): Response
    {
//        dd($productPresentation->getLatest(1));
        return $this->render('default/index.html.twig', [
            'latestProducts' => $productPresentation->getLatest(16),
            'categories' => $categoryService->getCategories(),
        ]);
    }
}
