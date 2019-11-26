<?php

namespace App\Controller;

use App\Service\Image\ImagePresentationServiceInterface;
use App\Service\Product\ProductPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products/product-{id}", name="product")
     * @param int $id
     * @param ProductPresentationServiceInterface $productPresentationService
     * @param ImagePresentationServiceInterface $imagePresentationService
     * @return Response
     */
    public function showProduct(int $id, ProductPresentationServiceInterface $productPresentationService, ImagePresentationServiceInterface $imagePresentationService): Response
    {
        return $this->render('product/product.html.twig', [
            'product' => $productPresentationService->getById($id),
            'images' => $imagePresentationService->getImagesByProductId($id),
        ]);
    }
}
