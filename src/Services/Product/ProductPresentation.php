<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Entity\Product;
use App\Service\Collection\ProductCollection;

class ProductPresentation implements ProductPresentationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPublished(): ProductCollection
    {
        // TODO: Implement getLatest() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getProductById(int $id): Product
    {
        // TODO: Implement getProductById() method.
    }
}