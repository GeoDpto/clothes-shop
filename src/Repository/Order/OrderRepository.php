<?php

namespace App\Repository\Order;

use App\Entity\Order;
use App\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    /**
     * @param array $data
     * @param string $mail
     * @param array $checkoutProducts
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addOrder(array $data, string $mail, array $checkoutProducts): void
    {
        $em = $this->getEntityManager();
        $customer = $em->getRepository('App:Customer')->findOneBy(['email' => $mail]);

        $order = new Order();

        $order->setCustomer($customer)
            ->setDate(new \DateTimeImmutable())
        ;

        foreach ($checkoutProducts as $checkoutProduct) {
            $product = $em->getRepository('App:Product')->findOneBy(['id' => $checkoutProduct->getId()]);
            $order->addProduct($product);
        }

        $em->persist($order);

        $em->flush();
    }

    /**
     * @param int $id
     * @return Order
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getById(int $id): Order
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->from(Order::class, 'o')
            ->select('o', 'c', 'p')
            ->leftJoin('o.customer', 'c')
            ->innerJoin('o.productId', 'p')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getSingleResult()
        ;

        if (!$query) {
            throw new EntityNotFoundException('order');
        }

        return $query;
    }

    public function getOrders(): iterable
    {
        return $this->createQueryBuilder('o')
            ->getQuery()
            ->getResult()
            ;
    }
}
