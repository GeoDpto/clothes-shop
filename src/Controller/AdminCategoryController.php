<?php

namespace App\Controller;

use App\Form\CreateCategoryType;
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

    /**
     * AdminCategoryController constructor.
     * @param CategoryServiceInterface $categoryService
     * @param CategoryAdminServiceInterface $categoryAdminService
     */
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
            'categories' => $this->categoryService->getAll(),
            'success' => $this->success,
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update(int $id, Request $request): Response
    {
        $form = $this->createForm(EditCategoryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->success = true;

            $this->categoryAdminService->updateCategory($id, $form->getData());
        }

        return $this->render('admin/category/update.html.twig', [
            'category' => $this->categoryAdminService->getById($id),
            'products' => $this->categoryAdminService->getProductsById($id),
            'EditCategoryForm' => $form->createView(),
            'success' => $this->success,
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $this->success = true;

        $this->categoryAdminService->deleteCategory($id);

        return $this->forward('App\Controller\AdminCategoryController::show', []);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(CreateCategoryType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->success = true;
            $this->categoryAdminService->save($form->getData());
        }

        return $this->render('admin/category/create.html.twig', [
            'success' => $this->success,
            'createCategoryForm' => $form->createView(),
        ]);
    }
}
