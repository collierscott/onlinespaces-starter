<?php

namespace App\Repository;

use App\Entity\TwitterPageData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TwitterPageData|null find($id, $lockMode = null, $lockVersion = null)
 * @method TwitterPageData|null findOneBy(array $criteria, array $orderBy = null)
 * @method TwitterPageData[]    findAll()
 * @method TwitterPageData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TwitterPageDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TwitterPageData::class);
    }

    // /**
    //  * @return TwitterPageData[] Returns an array of TwitterPageData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TwitterPageData
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
