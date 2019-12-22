<?php

declare(strict_types=1);

namespace App\Repository\Contact;

use App\Entity\Contact;

interface ContactRepositoryInterface
{
    /**
     * @param Contact $contact
     */
    public function save(Contact $contact): void;
}
