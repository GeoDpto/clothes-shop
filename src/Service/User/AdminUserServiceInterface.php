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
     * @return User
     */
    public function getById(int $id): User;

    /**
     * @param User $user
     */
    public function addUser(User $user): void;

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
