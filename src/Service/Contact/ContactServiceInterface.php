<?php

declare(strict_types=1);

namespace App\Service\Contact;

interface ContactServiceInterface
{
    /**
     * @param array $data
     */
    public function insertContactData(array $data): void;
}
