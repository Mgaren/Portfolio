<?php

namespace App\Repository;

use App\Entity\ProjetPerso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProjetPerso|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjetPerso|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjetPerso[]    findAll()
 * @method ProjetPerso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetPersoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProjetPerso::class);
    }

    // /**
    //  * @return ProjetPerso[] Returns an array of ProjetPerso objects
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
    public function findOneBySomeField($value): ?ProjetPerso
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
