<?php

namespace App\Controller;

use App\Form\ExportType;
use App\Service\Export\ExportServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminExportController extends AbstractController
{
    /**
     * @Route("/admin/export/", name="admin_export")
     * @param Request $request
     * @param ExportServiceInterface $exportService
     * @return Response
     */
    public function export(Request $request, ExportServiceInterface $exportService): Response
    {
        $form = $this->createForm(ExportType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $filename = sprintf('products_%s.csv', date('Y-m-d'));

            $file = $exportService->export($form->getData());

            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="'.$filename.'";');

            fpassthru($file);
        }

        return $this->render('admin/export/export.html.twig', [
            'formExport' => $form->createView(),
        ]);
    }
}
