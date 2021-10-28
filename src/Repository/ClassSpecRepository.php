<?php

namespace App\Repository;

use App\Entity\ClassSpec;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ClassSpec|null find($id, $lockMode = null, $lockVersion = null)
 * @method ClassSpec|null findOneBy(array $criteria, array $orderBy = null)
 * @method ClassSpec[]    findAll()
 * @method ClassSpec[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClassSpecRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClassSpec::class);
    }

    // /**
    //  * @return ClassSpec[] Returns an array of ClassSpec objects
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
    public function findOneBySomeField($value): ?ClassSpec
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
