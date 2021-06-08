<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Announcement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserLoaderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function loadUserByUsername($username)
    {
        return $this->createQueryBuilder('u')
            ->where('u.Email = :email')
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function insertUser(User $user)
    {   
        $em = $this->getEntityManager();
        $em->persist($user);
        $em->flush();
    }

    public function updateUser(User $user)
    {
        $em = $this->getEntityManager();
        $em->merge($user);
        $em->flush();
    }

    public function getUserById(int $id)
    {
        $dql = 'SELECT u FROM App\Entity\User u WHERE u.id =:id';
        $query = $this->getEntityManager()->createQuery($dql)
            ->setParameter('id',$id);
        return $query->execute();
    }
}
