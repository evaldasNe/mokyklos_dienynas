<?php

namespace App\Repository;

use App\Entity\HomeWork;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method HomeWork|null find($id, $lockMode = null, $lockVersion = null)
 * @method HomeWork|null findOneBy(array $criteria, array $orderBy = null)
 * @method HomeWork[]    findAll()
 * @method HomeWork[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HomeWorkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HomeWork::class);
    }

    // /**
    //  * @return HomeWork[] Returns an array of HomeWork objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HomeWork
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
