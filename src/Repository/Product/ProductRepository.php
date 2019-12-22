<?php

namespace App\Repository\Product;

use App\Entity\Product;
use App\Exception\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\ORMException;

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
            ->andWhere('p.createdAt IS NOT NULL')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
        ;

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getById(int $id): Product
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.id = :id')
            ->setParameter('id', $id)
            ->andWhere('p.createdAt IS NOT NULL')
            ->leftJoin('p.images', 'i')
            ->addSelect('i')
            ->getQuery()
        ;

        $result = $query->getOneOrNullResult();

        if (!$result) {
            throw new EntityNotFoundException('product');
        }

        return $result;

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

    /**
     * {@inheritdoc}
     */
    public function getProducts(): iterable
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * {@inheritdoc}
     */
    public function addProduct(Product $product): void
    {
        $em = $this->getEntityManager();

        $em->persist($product);

        $em->flush();
    }

    /**
     * Deletes product by id.
     *
     * @param int $id
     * @throws ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteById(int $id): void
    {
        $em = $this->getEntityManager();

        try {
            $em->remove($this->getById($id));
        } catch (ORMException $exception) {
            throw new EntityNotFoundException('product');
        }

        $em->flush();
    }
}
