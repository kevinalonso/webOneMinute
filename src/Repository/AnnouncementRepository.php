<?php

namespace App\Repository;

use App\Entity\Announcement;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Announcement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Announcement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Announcement[]    findAll()
 * @method Announcement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnnouncementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Announcement::class);
    }

    public function insert(Announcement $a, int $categoryId)
    {
        //Get relationship with category and annoucenemnt
        $category = $this->getEntityManager()->getReference('App\Entity\Category', $categoryId);
        $a->setCategory($category);

        //insert in table announcement new item
        $em = $this->getEntityManager();
        $em->persist($a);
        $em->flush();
    }

    public function getAnnoucementFromCategory(int $idCat): array
    {
        $dql = 'SELECT a FROM App\Entity\Announcement a WHERE a.Category =:idCat';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('idCat',$idCat);
        return $query->execute();
    }

    public function getAnnoucementFromUser(int $idUser): array
    {
        $dql = 'SELECT a FROM App\Entity\Announcement a WHERE a.User =:idUser';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('idUser',$idUser);
        return $query->execute();
    }

    public function getAnnouncementById(int $id): array
    {
        $dql = 'SELECT a FROM App\Entity\Announcement a WHERE a.id =:id';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('id',$id);
        return $query->execute();
    }

    public function deleteAnnouncement(int $id)
    {
        $dql = 'DELETE App\Entity\Announcement a WHERE a.id =:id';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('id',$id);
        $query->execute();
    }

    public function getTop10Annoucement(): array
    {
        $dql = 'SELECT a FROM App\Entity\Announcement a ORDER BY a.id DESC';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setMaxResults(10);
        return $query->execute();
    }

    // /**
    //  * @return Announcement[] Returns an array of Announcement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Announcement
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
