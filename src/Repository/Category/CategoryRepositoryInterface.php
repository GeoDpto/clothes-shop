<?php

declare(strict_types=1);

namespace App\Repository\Category;

use App\Collection\CategoryCollection;
use App\Entity\Category;

interface CategoryRepositoryInterface
{
    /**
     * Returns collection of categories.
     *
     * @return iterable
     */
    public function getAll(): iterable;

    /**
     * Returns collection of articles in category by slug.
     * @param string $slug
     * @return iterable
     */
    public function getProductsBySlug(string $slug): iterable;

    /**
     * Returns category by slug.
     * @param string $slug
     * @return Category
     */
    public function getBySlug(string $slug): Category;

    /**
     * @param int $id
     * @return Category
     */
    public function getById(int $id): Category;

}
