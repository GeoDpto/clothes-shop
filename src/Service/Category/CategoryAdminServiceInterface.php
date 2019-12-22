<?php

declare(strict_types=1);

namespace App\Service\Category;

use App\Entity\Category;

interface CategoryAdminServiceInterface
{
    public function getById(int $id): Category;

    /**
     * Updates created category.
     * @param int $id
     * @param array $data
     */
    public function updateCategory(int $id, array $data): void;

    /**
     * Deletes category.
     */
    public function deleteCategory(int $id): void;

    /**
     * Creates new category.
     */
    public function save(array $data): void;
}
