<?php

namespace App\Repository;

use App\Entity\Email;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Email|null find($id, $lockMode = null, $lockVersion = null)
 * @method Email|null findOneBy(array $criteria, array $orderBy = null)
 * @method Email[]    findAll()
 * @method Email[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Email::class);
    }

   public function getEmail(string $key): array
    {
        $dql = 'SELECT e FROM App\Entity\Email e WHERE e.KeyEmail =:key';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('key',$key);
        return $query->execute();
    }
}
