<?php

declare(strict_types=1);

namespace App\Exception;

class CollectionIsEmptyException extends \RuntimeException
{
    public function __construct($collectionName, $code = 0, \Throwable $previous = null)
    {
        parent::__construct(\sprintf('Error. Collection %s is empty.', $collectionName), $code, $previous);
    }
}
