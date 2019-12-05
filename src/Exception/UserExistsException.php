<?php

declare(strict_types=1);

namespace App\Exception;

class UserExistsException extends \DomainException
{
    /**
     * UserExistsException constructor.
     * @param string $email
     * @param \Throwable|null $previous
     */
    public function __construct(string $email, \Throwable $previous = null)
    {
        parent::__construct(sprintf('User with email %s exists.', $email), 0, $previous);
    }
}
