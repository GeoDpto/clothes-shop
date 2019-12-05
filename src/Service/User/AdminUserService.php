<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Exception\EntityNotFoundException;
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
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getById(int $id): User
    {
        $user = $this->userRepository->getById($id);

        if (!$user) {
            throw new EntityNotFoundException('user');
        }

        return $user;
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
