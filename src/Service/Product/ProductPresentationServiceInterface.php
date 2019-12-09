<?php

declare(strict_types=1);

namespace App\Service\Product;

use App\Collection\ProductCollection;
use App\Entity\Product;
use Knp\Component\Pager\Pagination\PaginationInterface;

interface ProductPresentationServiceInterface
{
    /**
     * @param $int
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

    public function getPaginatedProducts(int $int = 0): PaginationInterface;

    /**
     * @return ProductCollection
     */
    public function getProducts(): ProductCollection;
}
