<?php

namespace App\Controller;

use App\Service\Category\CategoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/products/category/{slug}", name="category")
     * @param string $slug
     * @param CategoryServiceInterface $categoryService
     * @return Response
     */
    public function showCategory(string $slug, CategoryServiceInterface $categoryService): Response
    {
        return $this->render('category/category.html.twig', [
            'categories' => $categoryService->getCategories(),
            'products' => $categoryService->getProductsBySlug($slug),
        ]);
    }
}
