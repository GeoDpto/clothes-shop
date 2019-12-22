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
     * @param int $count
     * @return ProductCollection
     */
    public function getLatest(int $count): iterable;

    /**
     * @return iterable
     */
    public function getProducts(): iterable;

    /**
     * @param Product $product
     */
    public function save(Product $product): void;
}
