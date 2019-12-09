<?php

namespace App\Controller;

use App\Repository\Order\OrderRepository;
use App\Service\Checkout\OrderServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminOrderController extends AbstractController
{
    /**
     * @var OrderServiceInterface
     */
    private $orderService;

    /**
     * AdminOrderController constructor.
     * @param OrderServiceInterface $orderService
     */
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * @Route("/admin/orders", name="admin_orders")
     */
    public function show()
    {
        return $this->render('admin/order/orders.html.twig', [
        ]);
    }
}
