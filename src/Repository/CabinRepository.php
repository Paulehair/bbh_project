<?php

namespace App\Repository;

use App\Entity\Cabin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cabin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cabin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cabin[]    findAll()
 * @method Cabin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CabinRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cabin::class);
    }

//    /**
//     * @return Cabin[] Returns an array of Cabin objects
//     */
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
    public function findOneBySomeField($value): ?Cabin
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
