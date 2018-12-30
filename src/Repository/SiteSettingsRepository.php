<?php

namespace App\Repository;

use App\Entity\Config\SiteSettings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SiteSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method SiteSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method SiteSettings[]    findAll()
 * @method SiteSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SiteSettingsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SiteSettings::class);
    }

    public function findOneByMostRecentSettings()
    {
        $result = $this->createQueryBuilder('s')
            ->orderBy('s.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
        return $result[0];
    }

    // /**
    //  * @return SiteSettings[] Returns an array of SiteSettings objects
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
    public function findOneBySomeField($value): ?SiteSettings
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
