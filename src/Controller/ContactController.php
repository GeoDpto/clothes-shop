<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function show()
    {
        $form = $this->createForm(ContactType::class);

        return $this->render('contact/contact.html.twig', [
            'contact_form' => $form->createView(),
        ]);
    }
}
