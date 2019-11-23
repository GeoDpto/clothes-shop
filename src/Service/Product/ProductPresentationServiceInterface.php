<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Collection\ProductCollection;
use App\Entity\Product;

interface ProductPresentationServiceInterface
{
    /**
     * @return ProductCollection
     */
    public function getPublished(): ProductCollection;

    /**
     * @param int $id
     * @return Product
     */
    public function getById(int $id): Product;

    /**
     * @param int $count
     * @return ProductCollection
     */
    public function getLatest(int $count = 20): ProductCollection;
}
