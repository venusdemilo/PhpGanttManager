<?php

namespace App\Repository;

use App\Entity\GanttData;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GanttData|null find($id, $lockMode = null, $lockVersion = null)
 * @method GanttData|null findOneBy(array $criteria, array $orderBy = null)
 * @method GanttData[]    findAll()
 * @method GanttData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GanttDataRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GanttData::class);
    }

    // /**
    //  * @return GanttData[] Returns an array of GanttData objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GanttData
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
