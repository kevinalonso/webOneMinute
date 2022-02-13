<?php

namespace App\Repository;

use App\Entity\Cgs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Cgs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cgs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cgs[]    findAll()
 * @method Cgs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CgsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cgs::class);
    }

    public function getCgs()
    {
        $dql = 'SELECT c FROM App\Entity\Cgs c';
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->execute();
    }

    // /**
    //  * @return Cgs[] Returns an array of Cgs objects
    //  */
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
    public function findOneBySomeField($value): ?Cgs
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
