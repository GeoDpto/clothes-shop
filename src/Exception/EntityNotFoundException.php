<?php

declare(strict_types=1);

namespace App\Exception;

class EntityNotFoundException extends \RuntimeException
{
    public function __construct(string $name, \Throwable $previous = null)
    {
        parent::__construct(\sprintf('%s not found.', $name), 0, $previous);
    }
}