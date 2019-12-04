<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDefaultController extends AbstractController
{
    /**
     * @Route("/admin/", name="admin_index")
     */
    public function index()
    {
        return $this->render('admin/default/default.html.twig', [

        ]);
    }
}
