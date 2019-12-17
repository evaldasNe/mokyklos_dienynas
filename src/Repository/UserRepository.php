<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @param string $value
     * @return array|null
     */
    public function findByRole(string $value): ?array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param string $value
     * @param string $last_name
     * @return array|null
     */
    public function findByRoleAndLastName(string $value, string $last_name): ?array
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :val')
            ->setParameter('val', '%'.$value.'%')
            ->andWhere('u.lastName LIKE :last_name')
            ->setParameter('last_name', '%'.$last_name.'%')
            ->orderBy('u.id', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
