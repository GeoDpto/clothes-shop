<?php

namespace App\Controller;

use App\Form\EditUserType;
use App\Service\User\AdminUserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{
    /**
     * @var AdminUserServiceInterface
     */
    private $adminUserService;

    public function __construct(AdminUserServiceInterface $adminUserService)
    {
        $this->adminUserService = $adminUserService;
    }

    /**
     * @Route("/admin/users", name="admin_user")
     */
    public function show(): Response
    {
        return $this->render('admin/users/users.html.twig', [
            'users' => $this->adminUserService->showUsers(),
        ]);
    }

    public function update(int $id, Request $request): Response
    {
        $successMessage = false;

        $user = $this->adminUserService->getById($id);

        $form = $this->createForm(EditUserType::class);
        $form->get('email')->setData($user->getEmail());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $successMessage = true;


        }

        return $this->render('admin/users/update.html.twig', [
                'user' => $user,
                'success' => $successMessage,
                'editUserForm' => $form->createView(),
        ]);
    }
}
