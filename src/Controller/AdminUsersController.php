<?php

namespace App\Controller;

use App\Service\User\AdminUserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminUsersController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_user")
     * @param AdminUserServiceInterface $adminUserService
     * @return Response
     */
    public function show(AdminUserServiceInterface $adminUserService): Response
    {
        return $this->render('admin/users/users.html.twig', [
            'users' => $adminUserService->showUsers(),
        ]);
    }
}
