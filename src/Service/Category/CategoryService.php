<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Collection\CategoryCollection;
use App\Entity\Category;

class CategoryService implements CategoryServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getCategoryPostsBySlug(string $slug): CategoryCollection
    {
        // TODO: Implement getCategoryPostsBySlug() method.
    }



    /**
     * {inheritdoc}.
     */
    public function getBySlug(string $slug): Category
    {
        // TODO: Implement getBySlug() method.
    }
}
