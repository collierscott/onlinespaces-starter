<?php

namespace App\Repository;

use App\Entity\FacebookPageData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FacebookPageData|null find($id, $lockMode = null, $lockVersion = null)
 * @method FacebookPageData|null findOneBy(array $criteria, array $orderBy = null)
 * @method FacebookPageData[]    findAll()
 * @method FacebookPageData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FacebookPageDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FacebookPageData::class);
    }

    // /**
    //  * @return SocialFacebook[] Returns an array of SocialFacebook objects
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
    public function findOneBySomeField($value): ?SocialFacebook
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
