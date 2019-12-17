<?php

namespace App\Controller;

use App\Form\ExportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminExportController extends AbstractController
{
    /**
     * @Route("/admin/export/", name="admin_export")
     * @param Request $request
     * @return Response
     */
    public function export(Request $request): Response
    {
        $form = $this->createForm(ExportType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isSubmitted()) {
            dd($form->getData());
        }

        return $this->render('admin/export/export.html.twig', [
            'formExport' => $form->createView(),
        ]);
    }
}
