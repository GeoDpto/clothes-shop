<?php

declare(strict_types=1);

namespace App\Service\Collection;

use App\Entity\Product;
use App\Service\Product\ProductPresentationInterface;

class ProductCollection implements ProductPresentationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getLatest(): ProductCollection
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
