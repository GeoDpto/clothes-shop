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
     * @param Order $order
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addOrder(Order $order): void
    {
        $em = $this->getEntityManager();

        $em->persist($order);

        $em->flush();
    }

    /**
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
            ->getOneOrNullResult()
        ;

        if (!$query) {
            throw new EntityNotFoundException('order');
        }

        return $query;
    }

    /**
     * @return iterable
     */
    public function getOrders(): iterable
    {
        return $this->createQueryBuilder('o')
            ->getQuery()
            ->getResult()
            ;
    }

    public function delete(int $id): void
    {
        $em = $this->getEntityManager();

        $order = $this->getById($id);

        if (!$order) {
            throw new EntityNotFoundException('order');
        }

        $em->remove($order);

        $em->flush();
    }
}
