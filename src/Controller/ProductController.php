<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @param int $id
     * @return Response
     *
     * @Route("/products/product-{id}", name="product")
     */
    public function showProduct(): Response
    {
        return $this->render('product/product.html.twig', [
        ]);
    }
}
