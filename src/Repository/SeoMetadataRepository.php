<?php

namespace App\Repository;

use App\Entity\SeoMetadata;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SeoMetadata|null find($id, $lockMode = null, $lockVersion = null)
 * @method SeoMetadata|null findOneBy(array $criteria, array $orderBy = null)
 * @method SeoMetadata[]    findAll()
 * @method SeoMetadata[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeoMetadataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SeoMetadata::class);
    }

    // /**
    //  * @return SeoMetadata[] Returns an array of SeoMetadata objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SeoMetadata
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
