<?php

declare(strict_types=1);

namespace App\Service\Image;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ImageUploadServiceInterface
{
    /**
     * Moves file into uploads directory and returns upload directory.
     *
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file): string;
}
