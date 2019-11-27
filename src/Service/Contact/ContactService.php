<?php

declare(strict_types=1);

namespace App\Service\Contact;

use App\Repository\Contact\ContactRepositoryInterface;

class ContactService implements ContactServiceInterface
{
    /**
     * @var ContactRepositoryInterface
     */
    private $contactRepository;

    /**
     * ContactService constructor.
     * @param ContactRepositoryInterface $contactRepository
     */
    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function insertContactData(array $data): void
    {
        $this->contactRepository->insertContactData($data);
    }
}
