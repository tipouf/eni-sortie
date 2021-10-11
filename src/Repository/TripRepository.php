<?php

namespace App\Repository;

use App\Entity\Contributor;
use App\Entity\Status;
use App\Entity\Trip;
use App\Model\FilterModel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Trip|null find($id, $lockMode = null, $lockVersion = null)
 * @method Trip|null findOneBy(array $criteria, array $orderBy = null)
 * @method Trip[]    findAll()
 * @method Trip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trip::class);
    }

    public function findByFilters(FilterModel $filter, Contributor $user = null)
    {
        $qb = $this->createQueryBuilder('f')
            ->select('s', 'f')
            ->join('f.status', 's');

        if ($filter->isOrganizedByMe() && $user) {
            $qb = $qb
                ->andWhere(':user = f.promoterContributor')
                ->setParameter('user', $user->getId());
        }
        if ($filter->isMySubscription() && $user) {
            $qb = $qb
                ->andWhere(':user MEMBER OF f.contributors')
                ->setParameter('user', $user->getId());
        }
        if ($filter->isNotSubscribed() && $user) {
            $qb = $qb
                ->andWhere(':user NOT MEMBER OF f.contributors')
                ->setParameter('user', $user->getId());
        }
        if ($filter->isTripPassed()) {
            $qb = $qb
                ->andWhere('s.label = :status')
                ->setParameter('status', Status::PASSED);
        } else {
            $qb = $qb
                ->andWhere('s.label != :status')
                ->setParameter('status', Status::PASSED);
        }
        if ($filter->getNameSearch() && $filter->getNameSearch() !== "") {
            $qb = $qb
                ->andWhere('f.name LIKE :name')
                ->setParameter('name', '%'.$filter->getNameSearch().'%');
        }
        if ($filter->getCampus()) {
            $qb = $qb
                ->andWhere('f.promoter = :campusId')
                ->setParameter('campusId', $filter->getCampus()->getId());
        }
        if ($filter->getDateEndedAt()) {
            $qb = $qb
                ->andWhere('f.startedAt <= :limitDate')
                ->setParameter('limitDate', $filter->getDateEndedAt());
        }
        if ($filter->getDateStartedAt()) {
            $qb = $qb
                ->andWhere('f.startedAt >= :startedDate')
                ->setParameter('startedDate', $filter->getDateStartedAt());
        }
        return $qb->getQuery()->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Trip
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByStatusName(string $status)
    {
        return $this->createQueryBuilder('t')
            ->addSelect('s')
            ->leftJoin('t.status', 's')
            ->where('s.label = :val')
            ->setParameter('val', $status)
            ->getQuery()
            ->getResult();
    }
}
