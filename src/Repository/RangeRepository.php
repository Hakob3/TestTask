<?php

namespace App\Repository;

use App\Entity\Range;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Range>
 *
 * @method Range|null find($id, $lockMode = null, $lockVersion = null)
 * @method Range|null findOneBy(array $criteria, array $orderBy = null)
 * @method Range[]    findAll()
 * @method Range[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Range::class);
    }


    /**
     * @param int $searchNumber
     * @return Range|null
     * @throws NonUniqueResultException
     */
    public function findRangeBySearchNumber(int $searchNumber): ?Range
    {
        return $this->createQueryBuilder('r')
            ->where(":searchNumber BETWEEN r.min AND r.max")
            ->setParameter('searchNumber', str_pad($searchNumber, 19, '0'))
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

//    /**
//     * @return Range[] Returns an array of Range objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Range
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
