<?php

namespace App\Repository\Contact;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository implements ContactRepositoryInterface
{
    /**
     * ContactRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * {@inheritdoc}
     */
    public function insertContactData(array $data): void
    {
        $em = $this->getEntityManager();
        $contact = new Contact();

        $contact->setName($data['name'])
            ->setEmail($data['email'])
            ->setSubject($data['subject'])
            ->setMessage($data['message'])
        ;

        $em->persist($contact);

        $em->flush();
    }
}
