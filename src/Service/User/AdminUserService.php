<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Exception\EntityNotFoundException;
use App\Exception\UserExistsException;
use App\Exception\UserNotExistsException;
use App\Repository\User\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * AdminUserService constructor.
     */
    public function __construct(UserRepository $userRepository,
                                EntityManagerInterface $entityManager,
                                UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->userPasswordEncoder = $userPasswordEncoder;
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
    public function add(array $data): void
    {
        if ($this->entityManager->getRepository('App:User')->findOneBy(['email' => $data['email']])) {
            throw new UserExistsException($data['email']);
        }

        $user = new User($data['email']);

        $user->setRoles((array) $data['roles'])
             ->setPasswordHash($this->userPasswordEncoder->encodePassword($user, $data['passwordHash']))
        ;

        $this->userRepository->add($user);
    }

    /**
     * {@inheritdoc}
     *
     * @param int $id
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(int $id): void
    {
        $user = $this->getById($id);

        if (!$user) {
            throw new UserNotExistsException($id);
        }

        $this->userRepository->delete($user);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function update(int $id, array $data): void
    {
        $user = $this->getById($id);

        $user->setEmail($data['email']);

        if (!empty($data['password'])) {
            $user->setPasswordHash($this->userPasswordEncoder->encodePassword($user, $data['password']));
        }

        $this->entityManager->flush();
    }
}
