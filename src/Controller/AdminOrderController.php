<?php

namespace App\Controller;

use App\Service\Checkout\OrderServiceInterface;
use App\Service\Order\AdminOrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOrderController extends AbstractController
{
    /**
     * @var bool
     */
    private $success = false;

    /**
     * @var OrderServiceInterface
     */
    private $adminOrderService;

    /**
     * AdminOrderController constructor.
     * @param AdminOrderServiceInterface $adminOrderService
     */
    public function __construct(AdminOrderServiceInterface $adminOrderService)
    {
        $this->adminOrderService = $adminOrderService;
    }

    /**
     * @Route("/admin/orders", name="admin_orders")
     */
    public function orders(): Response
    {
        return $this->render('admin/order/orders.html.twig', [
            'orders' => $this->adminOrderService->getOrders(),
            'success' => $this->success,
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return $this->render('admin/order/show.html.twig', [
           'order' => $this->adminOrderService->getById($id),
        ]);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $this->success = true;

        $this->adminOrderService->deleteById($id);

        return $this->redirectToRoute('admin_orders');
    }
}
