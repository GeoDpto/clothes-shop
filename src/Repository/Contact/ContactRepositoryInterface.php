<?php

declare(strict_types=1);

namespace App\Repository\Contact;

interface ContactRepositoryInterface
{
    /**
     * @param array $data
     */
    public function insertContactData(array $data): void;
}
