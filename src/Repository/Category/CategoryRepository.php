<?php

namespace App\Repository\Category;

use App\Entity\Category;
use App\Entity\Product;
use App\Exception\CategoryNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getAll(): iterable
    {
        $query = $this->createQueryBuilder('c')
            ->getQuery();

        return $query->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function getProductsBySlug(string $slug): iterable
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->addSelect('p')
            ->from(Product::class, 'p')
            ->leftJoin('p.category', 'c')
            ->andWhere('c.slug = :slug')
            ->setParameter('slug', $slug)
            ->andWhere('p.createdAt IS NOT NULL')
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ;

        $data = $query->getResult();

        if (!$data) {
            throw new CategoryNotFoundException($slug);
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     *
     * @throws NonUniqueResultException
     */
    public function getBySlug(string $slug): Category
    {
        $query = $this->createQueryBuilder('c')
            ->andWhere('c.slug = :slug')
            ->setParameter('slug', $slug)
            ->setMaxResults('1')
            ->getQuery()
        ;

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            throw new CategoryNotFoundException($slug);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @throws NonUniqueResultException
     */
    public function getById(int $id): Category
    {
        $query = $this->createQueryBuilder('c')
            ->where('c.id = :id')
            ->setParameter('id', $id)
            ->setMaxResults('1')
            ->getQuery()
        ;

        try {
            return $query->getSingleResult();
        } catch (NoResultException $e) {
            throw new CategoryNotFoundException($id);
        }
    }

    public function delete(Category $category): void
    {
        $em = $this->getEntityManager();

        $em->remove($category);

        $em->flush();
    }

    /**
     * @param Category $category
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Category $category): void
    {
        $em = $this->getEntityManager();

        $em->persist($category);

        $em->flush();
    }

    /**
     * @param int $id
     * @return iterable
     */
    public function getProductsById(int $id): iterable
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->addSelect('p')
            ->from(Product::class, 'p')
            ->leftJoin('p.category', 'c')
            ->andWhere('c.id = :id')
            ->setParameter('id', $id)
            ->orderBy('p.createdAt', 'DESC')
            ->getQuery()
        ;

        return $query->getResult();
    }
}
