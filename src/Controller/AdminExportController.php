<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminExportController extends AbstractController
{
    /**
     * @Route("/admin/export/", name="admin_export")
     */
    public function export()
    {
        return $this->render('admin/export/export.html.twig', [

        ]);
    }
}
