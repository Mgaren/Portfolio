<?php

namespace App\Repository;

use App\Entity\ProjetEquipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjetEquipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetEquipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetEquipe[]    findAll()
 * @method ProjetEquipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetEquipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjetEquipe::class);
    }

    // /**
    //  * @return ProjetEquipe[] Returns an array of ProjetEquipe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProjetEquipe
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
