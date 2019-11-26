<?php

declare(strict_types=1);

namespace App\Collection;

use App\Entity\Image;

class ImageCollection implements \IteratorAggregate
{
    /**
     * @var Image[]
     */
    private $images;

    /**
     * ImageCollection constructor.
     *
     * @param Image[] $images
     */
    public function __construct(Image ...$images)
    {
        $this->images = $images;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->images);
    }
}
