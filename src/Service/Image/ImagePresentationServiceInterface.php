<?php

declare(strict_types=1);

namespace App\Service\Image;

use App\Collection\ImageCollection;

interface ImagePresentationServiceInterface
{
    /**
     * @param int $id
     * @return ImageCollection
     */
    public function getImagesByProductId(int $id): ImageCollection;
}
