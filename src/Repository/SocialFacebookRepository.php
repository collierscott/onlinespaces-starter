<?php

namespace App\Repository;

use App\Entity\SocialFacebook;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SocialFacebook|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocialFacebook|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocialFacebook[]    findAll()
 * @method SocialFacebook[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialFacebookRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SocialFacebook::class);
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
