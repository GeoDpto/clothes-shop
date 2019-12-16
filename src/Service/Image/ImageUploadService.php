<?php

declare(strict_types=1);

namespace App\Service\Image;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadService implements ImageUploadServiceInterface
{
    /**
     * @var string
     */
    private $uploadDir;

    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    /**
     * {@inheritdoc}
     */
    public function upload(UploadedFile $file): string
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        try {
            $file->move(
                $this->getUploadDir(),
                $fileName
            );
        } catch (FileException $e) {
            $e->getMessage();
        }

        return $fileName;
    }

    public function getUploadDir(): string
    {
        return $this->uploadDir;
    }


}
