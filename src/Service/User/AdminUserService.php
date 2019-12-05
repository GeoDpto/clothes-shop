<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Exception\EntityNotFoundException;
use App\Repository\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class AdminUserService implements AdminUserServiceInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * AdminUserService constructor.
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
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

    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function updateUser(int $id, array $data): void
    {
        $user = $this->getById($id);

        $user->setEmail($data['email']);

        if (!empty($data['password'])) {
            $user->setPasswordHash(\bin2hex($data['email']));
        }

        $this->entityManager->flush();
    }
}
