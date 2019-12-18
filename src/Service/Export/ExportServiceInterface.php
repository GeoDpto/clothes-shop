<?php

declare(strict_types=1);

namespace App\Service\Export;

interface ExportServiceInterface
{
    /**
     * @param array $data
     */
    public function export(array $data): void;
}
