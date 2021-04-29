<?php

namespace App\Repository;

use App\Entity\Sale;
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

    public function insertSale(string $cmd,float $price)
    {
        //Get relationship with category and annoucenemnt
        $sale = new Sale();

        $sale->setDateofSale(new \DateTime('now'));
        $sale->setCommand($cmd);
        $sale->setPrice($price);
        $sale->setCgv(true);

        //insert in table announcement new item
        $em = $this->getEntityManager();
        $em->persist($sale);
        $em->flush();
        return $sale->getCommand();
    }
}
