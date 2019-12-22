<?php

declare(strict_types=1);

namespace App\Service\Product;

interface ProductAdminServiceInterface
{
    /**
     * @param $id
     */
    public function deleteById($id): void;

    /**
     * @param array $data
     */
    public function save(array $data): void;
}
