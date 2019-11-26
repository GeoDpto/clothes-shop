<?php

namespace App\Repository\Image;

use App\Entity\Image;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Image|null find($id, $lockMode = null, $lockVersion = null)
 * @method Image|null findOneBy(array $criteria, array $orderBy = null)
 * @method Image[]    findAll()
 * @method Image[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Image::class);
    }

    /**
     * @param int $id
     * @return iterable
     */
    public function getImagesByProductId(int $id): iterable
    {
        $query = $this->createQueryBuilder('i')
            ->where('i.product = :id')
            ->setParameter('id', $id)
            ->setMaxResults(5)
            ->getQuery();

        return $query->getResult();
    }
}
