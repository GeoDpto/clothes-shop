<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\Contact\ContactServiceInterface;
use Swift_Mailer;
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
     * @param Swift_Mailer $mailer
     * @return Response
     */
    public function show(Request $request, ContactServiceInterface $contactService, \Swift_Mailer $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $message = (new \Swift_Message('Hello Email'))
                ->setFrom('send@example.com')
                ->setTo('recipient@example.com')
                ->setBody(
                    $this->renderView('email/contact_email.html.twig',
                        [
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'subject' => $data['subject'],
                            'message' => $data['message'],
                        ]
                    ),
                    'text/html'
                );

            $mailer->send($message);

            $contactService->insertContactData($data);

            return $this->render('contact/success.html.twig', [
            ]);
        }

        return $this->render('contact/contact.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }
}
