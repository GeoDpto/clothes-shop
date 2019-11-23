<?php

declare(strict_types=1);

namespace App\Exception;

class CategoryNotFoundException extends \RuntimeException
{
    public function __construct($categoryName, $code = 0, \Throwable $previous = null)
    {
        parent::__construct(\sprintf('Error. This category is incorrect: %s.', $categoryName), $code, $previous);
    }
}