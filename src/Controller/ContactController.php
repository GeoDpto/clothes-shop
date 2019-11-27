<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\Contact\ContactServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param Request $request
     * @param ContactServiceInterface $contactService
     * @return Response
     */
    public function show(Request $request, ContactServiceInterface $contactService): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactService->insertContactData($form->getData());

            return $this->render('contact/success.html.twig', [
            ]);
        }

        return $this->render('contact/contact.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }
}
