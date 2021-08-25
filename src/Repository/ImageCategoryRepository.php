<?php

namespace App\Repository;

use App\Entity\ImageCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ImageCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageCategory[]    findAll()
 * @method ImageCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageCategory::class);
    }

    public function getImageFromCategory(int $idCat): array
    {
        $dql = 'SELECT a FROM App\Entity\ImageCategory a WHERE a.Category =:idCat';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('idCat',$idCat);
        return $query->execute();
    }
}
