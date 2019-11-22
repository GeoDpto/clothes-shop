<?php

namespace App\Controller;

use App\Service\Product\ProductPresentationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     * @param ProductPresentationServiceInterface $productPresentation
     * @return Response
     */
    public function index(ProductPresentationServiceInterface $productPresentation): Response
    {
//        dd($productPresentation->getLatest(1));
        return $this->render('default/index.html.twig', [
            'latestProducts' => $productPresentation->getLatest(16),
        ]);
    }
}
