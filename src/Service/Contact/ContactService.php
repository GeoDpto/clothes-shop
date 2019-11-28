<?php

declare(strict_types=1);

namespace App\Service\Contact;

use App\Repository\Contact\ContactRepositoryInterface;
use Twig\Environment;

class ContactService implements ContactServiceInterface
{
    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $templating;

    /**
     * ContactService constructor.
     * @param ContactRepositoryInterface $contactRepository
     * @param \Swift_Mailer $mailer
     * @param Environment $templating
     */
    public function __construct(ContactRepositoryInterface $contactRepository, \Swift_Mailer $mailer, Environment $templating)
    {
        $this->contactRepository = $contactRepository;
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * {@inheritdoc}
     */
    public function insertContactData(array $data): void
    {
        $this->contactRepository->insertContactData($data);
    }

    /**
     * {@inheritdoc}
     */
    public function sendMail(array $data): void
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->templating->render('email/contact_email.html.twig',
                    [
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'subject' => $data['subject'],
                        'message' => $data['message'],
                    ]
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }
}
