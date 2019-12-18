<?php

declare(strict_types=1);

namespace App\Service\Contact;

use App\Entity\Contact;

interface ContactServiceInterface
{
    /**
     * @param Contact $contact
     */
    public function insertContactData(Contact $contact): void;

    /**
     * @param Contact $data
     */
    public function sendMail(Contact $data): void;
}
