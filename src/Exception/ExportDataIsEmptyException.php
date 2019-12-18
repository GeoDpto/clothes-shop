<?php

declare(strict_types=1);

namespace App\Exception;

class ExportDataIsEmptyException extends \Exception
{
    public function __construct(\Throwable $previous = null)
    {
        parent::__construct('Error. Nothing to export. Product list is empty', 0, $previous);
    }
}