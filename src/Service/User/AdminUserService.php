<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Repository\User\UserRepository;

class AdminUserService implements AdminUserServiceInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * AdminUserService constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function showUsers(): array
    {
        return $this->userRepository->getUsers();
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): User
    {
        // TODO: Implement getById() method.
    }

    /**
     * {@inheritdoc}
     */
    public function addUser(User $user): void
    {
        // TODO: Implement addUser() method.
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById(int $id): void
    {
        // TODO: Implement deleteById() method.
    }
}
