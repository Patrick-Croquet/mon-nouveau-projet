<?php

namespace App\Repository;

use App\Entity\Auteur;
use App\Entity\Produit;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Auteur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Auteur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Auteur[]    findAll()
 * @method Auteur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuteurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auteur::class);
    }

    // /**
    //  * @return Auteur[] Returns an array of Auteur objects
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
    public function findOneBySomeField($value): ?Auteur
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findAuteursWithProduits()
    {
        return $this->createQueryBuilder('a')
        ->select('a.id','a.auteur', 'COUNT(p.auteur) as nblivres')
        ->innerJoin('a.produits', 'p', Join::WITH, 'a.id = p.auteur')
        ->groupBy('p.auteur')
        ->getQuery()
        ->getResult();
    }

    public function countAllAuteurs()
    {
        return $this->createQueryBuilder('a')
        ->select('COUNT(a.id) as nbauteurs')
        ->getQuery()
        ->getOneOrNullResult();   
    }
}
