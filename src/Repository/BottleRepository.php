<?php

namespace App\Repository;

use App\Entity\Bottle;
use App\Entity\Category;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bottle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bottle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bottle[]    findAll()
 * @method Bottle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BottleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bottle::class);
    }

    public function findAllByCategory(?Category $type = null, ?User $user = null)
    {
        $queryBuilder = $this->createQueryBuilder('b');

        if ($type) {
            $queryBuilder
                ->andWhere('b.type = :type')
                ->setParameter('type', $type)
            ;
        }

        if ($user) {
            $queryBuilder
                ->join('b.cave', 'c')
                ->andWhere('c.id = :id')
                ->setParameter('id', $user->getCave()->getId())
            ;
        }

        return $queryBuilder
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Bottle[] Returns an array of Bottle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Bottle
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
