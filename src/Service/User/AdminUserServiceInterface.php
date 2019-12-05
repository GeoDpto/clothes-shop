<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;

interface AdminUserServiceInterface
{
    /**
     * @return array
     */
    public function showUsers(): array;

    /**
     * @param int $id
     * @return User
     */
    public function getById(int $id): User;

    /**
     * @param array $data
     */
    public function addUser(array $data): void;

    /**
     * @param int $id
     */
    public function deleteById(int $id): void;

    /**
     * @param int $id
     * @param array $data
     */
    public function updateUser(int $id, array $data): void;
}
