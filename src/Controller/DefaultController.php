<?php

namespace App\Controller;

use App\Service\Product\ProductPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     * @param ProductPresentationServiceInterface $productPresentation
     * @return ResponseAlias
     */
    public function index(ProductPresentationServiceInterface $productPresentation)
    {
        return $this->render('default/index.html.twig', [
            'LatestProducts' => $productPresentation->getLatest(20),
        ]);
    }
}
