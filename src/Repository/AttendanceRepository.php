<?php

namespace App\Repository;

use App\Entity\Attendance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Attendance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attendance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attendance[]    findAll()
 * @method Attendance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttendanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attendance::class);
    }

    public function findByStudent($value): ?array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.student = :val')
            ->setParameter('val', $value)
            ->orderBy('o.student', 'DESC')
            ->getQuery()
            ->getResult()
            ;
    }
    public function findByDateAndStudent(string $value, string $date): ?array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.student LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->andWhere('u.date LIKE :date')
            ->setParameter('date', '%'.$date.'%')
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }
    // /**
    //  * @return Attendance[] Returns an array of Attendance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Attendance
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
