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

    public function getAnnouncementBuy(int $idUser): array
    {

        $dql = 'SELECT a, s.State FROM App\Entity\Announcement a INNER JOIN App\Entity\Sale s WITH a.id = s.IdAnnouncement WHERE s.IdBuyer =:id';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('id',$idUser);
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

    public function updateAnnouncement(Announcement $annoucement)
    {
        $em = $this->getEntityManager();
        $em->merge($annoucement);
        $em->flush();
    }

    public function getStatistics(int $idUser): array
    {
        $dql = 'SELECT a.id, a.Title, a.Price, s.Command, s.DateofSale, c.Name
            FROM App\Entity\Announcement a 
            INNER JOIN App\Entity\Category c WITH a.Category = c.id
            INNER JOIN App\Entity\Sale s WITH a.id = s.IdAnnouncement 
            WHERE s.IdBuyer =:idUser AND s.State =:state';

        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('idUser',$idUser)
            ->setParameter('state',"Service fait");

        return $query->execute();
    }

    public function getStatisticsByCat(int $idUser): array
    {
        $dql = 'SELECT c.Name, COUNT(c.Name), SUM(a.Price)
            FROM App\Entity\Announcement a 
            INNER JOIN App\Entity\Category c WITH a.Category = c.id
            INNER JOIN App\Entity\Sale s WITH a.id = s.IdAnnouncement 
            WHERE s.IdBuyer =:idUser AND s.State =:state
            GROUP BY a.id';
            
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('idUser',$idUser)
            ->setParameter('state',"Service fait");

        return $query->execute();
    }
}
