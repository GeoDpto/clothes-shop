<?php

declare(strict_types=1);

namespace App\Service\Image;

use App\Collection\ImageCollection;
use App\Repository\Image\ImageRepository;

class ImagePresentationService implements ImagePresentationServiceInterface
{
    /**
     * @var ImageRepository
     */
    private $imageRepository;

    /**
     * ImagePresentationService constructor.
     * @param ImageRepository $imageRepository
     */
    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getImagesByProductId(int $id): ImageCollection
    {
        return new ImageCollection(...$this->imageRepository->getImagesByProductId($id));
    }
}
