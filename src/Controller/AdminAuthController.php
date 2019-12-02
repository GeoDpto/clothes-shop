<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminAuthController extends AbstractController
{
    /**
     * @Route("/admin/auth", name="admin_auth")
     */
    public function auth()
    {
        return $this->render('admin/auth/login.html.twig', [
        ]);
    }
}
