<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/products/category/{slug}", name="category")
     */
    public function showCategory(): Response
    {
        return $this->render('products/index.html.twig', [
        ]);
    }
}
