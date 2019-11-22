<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Collection\ProductCollection;
use App\Entity\Product;

interface ProductPresentationInterface
{
    /**
     * @return ProductCollection
     */
    public function getPublished(): ProductCollection;

    /**
     * @param int $id
     * @return Product
     */
    public function getId(int $id): Product;

    /**
     * @return ProductCollection
     */
    public function getLatest(): ProductCollection;
}
