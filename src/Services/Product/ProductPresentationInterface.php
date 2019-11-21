<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Entity\Product;
use App\Service\Collection\ProductCollection;

interface ProductPresentationInterface
{
    /**
     * @return ProductCollection
     */
    public function getLatest(): ProductCollection;

    /**
     * @param int $id
     * @return Product
     */
    public function getProductById(int $id): Product;
}
