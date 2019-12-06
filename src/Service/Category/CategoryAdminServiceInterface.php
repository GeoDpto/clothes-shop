<?php

declare(strict_types=1);

namespace App\Service\Category;

interface CategoryAdminServiceInterface
{
    /**
     * Updates created category.
     * @param string $slug
     * @param array $data
     */
    public function updateCategory(string $slug, array $data): void;

    /**
     * Deletes category.
     * @param string $slug
     */
    public function deleteCategory(string $slug): void;

    /**
     * Creates new category.
     * @param array $data
     */
    public function createCategory(array $data): void;
}
