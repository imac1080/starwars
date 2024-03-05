<?php

namespace App\Repository;

use App\Entity\Charecters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Charecters>
 *
 * @method Charecters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Charecters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Charecters[]    findAll()
 * @method Charecters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharectersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Charecters::class);
    }

//    /**
//     * @return Charecters[] Returns an array of Charecters objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Charecters
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
