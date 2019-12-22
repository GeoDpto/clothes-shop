<?php

declare(strict_types=1);

namespace App\Service\Contact;

use App\Entity\Contact;

interface ContactServiceInterface
{
    /**
     * @param Contact $contact
     */
    public function save(Contact $contact): void;

    /**
     * @param Contact $data
     */
    public function sendMail(Contact $data): void;

    /**
     * @param Contact $data
     */
    public function handleCustomerService(Contact $data): void;
}
