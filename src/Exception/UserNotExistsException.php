<?php

declare(strict_types=1);

namespace App\Exception;

class UserNotExistsException extends \DomainException
{
    /**
     * UserExistsException constructor.
     * @param int $id
     * @param \Throwable|null $previous
     */
    public function __construct(int $id, \Throwable $previous = null)
    {
        parent::__construct(sprintf('User with id %s not exists.', $id), 0, $previous);
    }
}
