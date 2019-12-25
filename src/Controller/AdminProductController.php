<?php

namespace App\Controller;

use App\Form\CreateProductType;
use App\Service\Product\ProductAdminService;
use App\Service\Product\ProductAdminServiceInterface;
use App\Service\Product\ProductPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    /**
     * @var bool
     */
    private $success = false;

    /**
     * @var ProductPresentationServiceInterface
     */
    private $productPresentationService;
    /**
     * @var ProductAdminServiceInterface
     */
    private $productAdminService;

    /**
     * AdminProductController constructor.
     * @param ProductPresentationServiceInterface $productPresentationService
     * @param ProductAdminServiceInterface $productAdminService
     */
    public function __construct(ProductPresentationServiceInterface $productPresentationService,
                                ProductAdminServiceInterface $productAdminService)
    {
        $this->productPresentationService = $productPresentationService;
        $this->productAdminService = $productAdminService;
    }

    /**
     * @Route("/admin/products", name="admin_products")
     */
    public function show(): Response
    {
        return $this->render('admin/product/products.html.twig', [
            'products' => $this->productPresentationService->getProducts(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(CreateProductType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->productAdminService->save($form->getData());
            $this->success = true;
        }

        return $this->render('admin/product/create.html.twig', [
            'createProductForm' => $form->createView(),
            'success' => $this->success,
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $this->productAdminService->delete($id);

        return $this->redirectToRoute('admin_products');
    }
}
