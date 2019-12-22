<?php

declare(strict_types=1);

namespace App\Service\Contact;

use App\Entity\Contact;
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
     * @var string
     */
    private $sender;
    /**
     * @var string
     */
    private $recipient;

    /**
     * ContactService constructor.
     * @param string $sender
     * @param string $recipient
     * @param ContactRepositoryInterface $contactRepository
     * @param \Swift_Mailer $mailer
     * @param Environment $templating
     */
    public function __construct(string $sender,
                                string $recipient,
                                ContactRepositoryInterface $contactRepository,
                                \Swift_Mailer $mailer,
                                Environment $templating)
    {
        $this->contactRepository = $contactRepository;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->sender = $sender;
        $this->recipient = $recipient;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Contact $contact): void
    {
        $this->contactRepository->save($contact);
    }

    /**
     * {@inheritdoc}
     */
    public function sendMail(Contact $contact): void
    {
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom($this->sender)
            ->setTo($this->recipient)
            ->setBody(
                $this->templating->render('email/contact_email.html.twig',
                    [
                        'name' => $contact->getName(),
                        'email' => $contact->getEmail(),
                        'subject' => $contact->getSubject(),
                        'message' => $contact->getMessage(),
                    ]
                ),
                'text/html'
            );

        $this->mailer->send($message);
    }

    /**
     * {@inheritdoc}
     */
    public function handleCustomerService(Contact $data): void
    {
        $this->sendMail($data);

        $this->save($data);
    }
}
