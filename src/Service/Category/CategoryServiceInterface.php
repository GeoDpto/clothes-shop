<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Collection\CategoryCollection;
use App\Collection\ProductCollection;
use App\Entity\Category;

interface CategoryServiceInterface
{
    /**
     * Returns collection of categories.
     *
     * @return CategoryCollection
     */
    public function getCategories(): CategoryCollection;

    /**
     * Returns collection of articles in category by slug.
     *
     * @param string $slug
     * @return ProductCollection
     */
    public function getPostsBySlug(string $slug): ProductCollection;

    /**
     * Returns category by slug.
     *
     * @param string $slug
     * @return Category
     */
    public function getBySlug(string $slug): Category;
}
