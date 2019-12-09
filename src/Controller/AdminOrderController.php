<?php

namespace App\Controller;

use App\Repository\Order\OrderRepository;
use App\Service\Checkout\OrderServiceInterface;
use App\Service\Order\AdminOrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminOrderController extends AbstractController
{
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
    public function show()
    {
        return $this->render('admin/order/orders.html.twig', [
            'orders' => $this->adminOrderService->getOrders(),
        ]);
    }
}
