<?php

namespace App\Repository\Product;

use App\Collection\ProductCollection;
use App\Entity\Product;
use App\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    /**
     * ProductRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getPublished(): iterable
    {
        $query = $this->createQueryBuilder('p')
            ->innerJoin('p.category', 'c')
            ->addSelect('c')
            ->andWhere('p.publishedAt IS NOT NULL')
            ->orderBy('p.publishedAt', 'DESC')
            ->getQuery()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): Product
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->andWhere('p.publishedAt IS NOT NULL')
            ->getQuery()
        ;

        if (null !== $query->getOneOrNullResult()) {
            return $query->getOneOrNullResult();
        }

        throw new EntityNotFoundException('product');
    }

    /**
     * {@inheritdoc}
     */
    public function getLatest(int $count): iterable
    {
        $query = $this->createQueryBuilder('p')
            ->innerJoin('p.category', 'c')
            ->addSelect('c')
            ->andWhere('p.createdAt IS NOT NULL')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults($count)
            ->getQuery()
        ;

        return $query->getResult();
    }
}
