<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\Contact\ContactServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     *
     * @param Request $request
     * @param ContactServiceInterface $contactService
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function show(Request $request, ContactServiceInterface $contactService, \Swift_Mailer $mailer, ValidatorInterface $validator): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $errors = $validator->validate($data);

            dd($data);
            $contactService->sendMail($data);

            $contactService->insertContactData($data);

            return $this->render('contact/success.html.twig', [
            ]);
        }

        return $this->render('contact/contact.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }
}
