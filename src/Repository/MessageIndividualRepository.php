<?php

namespace App\Repository;

use App\Entity\MessageIndividual;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method MessageIndividual|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessageIndividual|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessageIndividual[]    findAll()
 * @method MessageIndividual[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageIndividualRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MessageIndividual::class);
    }

    // /**
    //  * @return MessageIndividual[] Returns an array of MessageIndividual objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MessageIndividual
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
