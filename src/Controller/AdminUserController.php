<?php

namespace App\Controller;

use App\Service\User\AdminUserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{
    /**
     * @var AdminUserServiceInterface
     */
    private $adminUserService;

    /**
     * AdminUsersController constructor.
     * @param AdminUserServiceInterface $adminUserService
     */
    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    /**
     * @Route("/admin/users", name="admin_user")
     *
     * @return Response
     */
    public function show(): Response
    {
        return $this->render('admin/users/users.html.twig', [
            'users' => $this->adminUserService->showUsers(),
        ]);
    }

    /**
     * @Route("/admin/users/user-{id}", name="admin_user_update")
     *
     * @param $id
     * @return Response
     */
    public function update(int $id): Response
    {
        return $this->render('admin/users/update.html.twig', [
            'user' => $this->adminUserService->getById($id),
        ]);
    }
}
