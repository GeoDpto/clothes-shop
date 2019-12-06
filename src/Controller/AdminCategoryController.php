<?php

namespace App\Controller;

use App\Service\Category\CategoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{
    /**
     * @var CategoryServiceInterface
     */
    private $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @Route("/admin/category", name="admin_category")
     */
    public function show()
    {
        return $this->render('admin/category/categories.html.twig', [
            'categories' => $this->categoryService->getCategories(),
        ]);
    }
}
