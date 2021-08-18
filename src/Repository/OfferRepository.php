<?php

namespace App\Repository;

use App\Entity\Offer;
use App\Entity\Sale;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Offer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offer[]    findAll()
 * @method Offer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfferRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offer::class);
    }


    public function getOfferById(int $id): array
    {
        $dql = 'SELECT o FROM App\Entity\Offer o WHERE o.id =:id';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('id',$id);
        return $query->execute();
    }

    public function insertOffer(Offer $offer)
    {
        $o = new Offer();

        
    }

    public function allOffers(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT offer
            FROM App\Entity\Offer offer');

        // returns an array of Product objects
        return $query->getResult();
    }

    public function getOfferBuy(int $idUser): array
    {

        $dql = 'SELECT o, s FROM App\Entity\Offer o INNER JOIN App\Entity\Sale s WITH o.id = s.IdAnnouncement WHERE s.IdBuyer =:id';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('id',$idUser);
        return $query->execute();
    }

    // /**
    //  * @return Offer[] Returns an array of Offer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Offer
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
