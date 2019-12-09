<?php

namespace App\Controller;

use App\Service\Product\ProductPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    /**
     * @var ProductPresentationServiceInterface
     */
    private $productPresentationService;

    public function __construct(ProductPresentationServiceInterface $productPresentationService)
    {
        $this->productPresentationService = $productPresentationService;
    }

    /**
     * @Route("/admin/product", name="admin_product")
     */
    public function show(): Response
    {
        return $this->render('admin/product/products.html.twig', [
            'products' => $this->productPresentationService->getProducts(),
        ]);
    }
}
