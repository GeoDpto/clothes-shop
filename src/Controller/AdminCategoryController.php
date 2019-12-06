<?php

namespace App\Controller;

use App\Form\EditCategoryType;
use App\Service\Category\CategoryAdminServiceInterface;
use App\Service\Category\CategoryServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{
    /**
     * @var bool
     */
    private $success = false;

    /**
     * @var CategoryServiceInterface
     */
    private $categoryService;
    /**
     * @var CategoryAdminServiceInterface
     */
    private $categoryAdminService;

    public function __construct(CategoryServiceInterface $categoryService, CategoryAdminServiceInterface $categoryAdminService)
    {
        $this->categoryService = $categoryService;
        $this->categoryAdminService = $categoryAdminService;
    }

    /**
     * @Route("/admin/category", name="admin_category")
     */
    public function show(): Response
    {
        return $this->render('admin/category/categories.html.twig', [
            'categories' => $this->categoryService->getCategories(),
        ]);
    }

    public function update(string $slug, Request $request): Response
    {
        $form = $this->createForm(EditCategoryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->success = true;

            $this->categoryAdminService->updateCategory($slug, $form->getData());
        }

        return $this->render('admin/category/update.html.twig', [
            'category' => $this->categoryService->getBySlug($slug),
            'products' => $this->categoryService->getProductsBySlug($slug),
            'EditCategoryForm' => $form->createView(),
            'success' => $this->success,
        ]);
    }
}
