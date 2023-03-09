<?php

namespace App\Repository;

use App\Entity\Bank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bank|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bank|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bank[]    findAll()
 * @method Bank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BankRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bank::class);
    }

    public function getRibFromUser(int $idBank): array
    {
        $dql = 'SELECT b FROM App\Entity\Bank b WHERE b.id =:idBank';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('idBank',$idBank);
        return $query->execute();
    }

    public function getRibUser(int $idBank): array
    {
        $dql = 'SELECT b FROM App\Entity\Bank b WHERE b.User =:idBank';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('idBank',$idBank);
        return $query->execute();
    }

    public function insertRib(Bank $bank)
    {   
        $em = $this->getEntityManager();
        $em->persist($bank);
        $em->flush();
    }

    public function updateBank(Bank $bank)
    {
        $em = $this->getEntityManager();
        $em->merge($bank);
        $em->flush();

    }
}
