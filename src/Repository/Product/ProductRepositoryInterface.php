<?php

declare(strict_types=1);

namespace App\Repository\Product;

use App\Collection\ProductCollection;
use App\Entity\Product;

interface ProductRepositoryInterface
{
    /**
     * @return ProductCollection
     */
    public function getPublished(): iterable;

    /**
     * @param int $id
     * @return Product
     */
    public function getById(int $id): Product;

    /**
     * @return ProductCollection
     */
    public function getLatest(int $count): iterable;
}
