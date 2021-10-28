<?php

namespace App\Repository;

use App\Entity\Dungeon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dungeon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dungeon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dungeon[]    findAll()
 * @method Dungeon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DungeonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dungeon::class);
    }

    // /**
    //  * @return Dungeon[] Returns an array of Dungeon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dungeon
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
