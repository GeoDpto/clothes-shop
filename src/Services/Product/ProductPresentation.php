<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Collection\ProductCollection;
use App\Entity\Product;

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
    public function getById(int $id): Product
    {
        // TODO: Implement getProductById() method.
    }

    /**
     * @return ProductCollection
     */
    public function getLatest(): ProductCollection
    {
        // TODO: Implement getLatest() method.
    }
}
