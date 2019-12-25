<?php

namespace App\Controller;

use App\Form\CreateUserType;
use App\Form\EditUserType;
use App\Service\User\AdminUserServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{
    /**
     * @var bool
     */
    private $successMessage = false;

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
            'success' => $this->successMessage,
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Response
     */
    public function update(int $id, Request $request): Response
    {
        $user = $this->adminUserService->getById($id);

        $form = $this->createForm(EditUserType::class);
        $form->get('email')->setData($user->getEmail());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->successMessage = true;

            $this->adminUserService->update($id, $form->getData());
        }

        return $this->render('admin/users/update.html.twig', [
                'user' => $user,
                'success' => $this->successMessage,
                'editUserForm' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $form = $this->createForm(CreateUserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->successMessage = true;

            $this->adminUserService->add($form->getData());
        }

        return $this->render('admin/users/create.html.twig', [
            'createUserForm' => $form->createView(),
            'success' => $this->successMessage,
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $this->successMessage = true;

        $this->adminUserService->delete($id);

        return $this->forward('App\Controller\AdminUserController::show', []);
    }
}
