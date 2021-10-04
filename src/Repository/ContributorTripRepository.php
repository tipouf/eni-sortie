<?php

namespace App\Repository;

use App\Entity\ContributorTrip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ContributorTrip|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContributorTrip|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContributorTrip[]    findAll()
 * @method ContributorTrip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContributorTripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContributorTrip::class);
    }

    // /**
    //  * @return ContributorTrip[] Returns an array of ContributorTrip objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ContributorTrip
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
