<?php

namespace App\Repository;

use App\Entity\Sale;
use App\Entity\Announcement;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sale|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sale|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sale[]    findAll()
 * @method Sale[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sale::class);
    }

    public function insertSale(string $cmd,Array $announcement, User $userBuyer)
    {
        //Get relationship with category and annoucenemnt
        $sale = new Sale();

        $sale->setDateofSale(new \DateTime('now'));
        $sale->setCommand($cmd);
        $sale->setIdAnnouncement($announcement[0]->getId());
        $sale->setPrice($announcement[0]->getPrice());
        $sale->setCgv(true);
        $sale->setState("Service non réalisé");

        $sale->setIdSeller($announcement[0]->getUser()->getId());
        $firstLastName = $announcement[0]->getUser()->getFirstName()." ".$announcement[0]->getUser()->getLastName();
        $sale->setSellerName($firstLastName);

        $firstLastNameBuyer = $userBuyer->getFirstName()." ".$userBuyer->getLastName();

        $sale->setBuyerName($firstLastNameBuyer);
        $sale->setIdBuyer($userBuyer->getId());

        //insert in table announcement new item
        $em = $this->getEntityManager();
        $em->persist($sale);
        $em->flush();
        return $sale->getCommand();
    }
}
