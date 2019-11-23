<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function show()
    {
        return $this->render('products/products.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }
}
