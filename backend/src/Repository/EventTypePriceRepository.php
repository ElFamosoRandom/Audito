<?php

namespace App\Repository;

use App\Entity\EventTypePrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EventTypePrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventTypePrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventTypePrice[]    findAll()
 * @method EventTypePrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventTypePriceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EventTypePrice::class);
    }

    // /**
    //  * @return EventTypePrice[] Returns an array of EventTypePrice objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EventTypePrice
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
