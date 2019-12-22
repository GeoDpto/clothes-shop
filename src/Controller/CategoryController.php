<?php

namespace App\Controller;

use App\Exception\CategoryNotFoundException;
use App\Service\Cart\CartService;
use App\Service\Category\CategoryServiceInterface;
use App\Service\Product\ProductPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/products/category/{slug}", name="category")
     *
     * @param string $slug
     * @param CategoryServiceInterface $categoryService
     * @param Request $request
     * @param CartService $cartService
     * @param ProductPresentationServiceInterface $presentationService
     * @return Response
     */
    public function showCategory(string $slug,
                                 CategoryServiceInterface $categoryService,
                                 Request $request,
                                 CartService $cartService,
                                 ProductPresentationServiceInterface $presentationService): Response
    {
        if ($request->isMethod('POST')) {
            $cartService->addProduct($presentationService->getById($request->request->get('product_id')));
        }

        try {
            $products = $categoryService->getProductsBySlug($slug);
        } catch (CategoryNotFoundException $exception) {
            throw $this->createNotFoundException('This category not found.');
        }

        return $this->render('category/category.html.twig', [
            'categories' => $categoryService->getAll(),
            'products' => $products,
        ]);
    }
}
