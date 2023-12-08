<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Produit>
 *
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    /**
     * @return Produit[] Returns an array of Produit objects
     */
    public function findAllMinMax($min, $max): array
    {
        $req = $this->createQueryBuilder('p')
        ->where('p.price >= :min')
        ->andWhere('p.price <= :max')
        ->setParameter('min', $min)
        ->setParameter('max', $max)
        ->orderBy('p.price', 'ASC')
        //->setMaxResults(10)
        ->getQuery();
        $resultat = $req->getResult();

        return $resultat;

    }
    public function findAllMinMax2($min, $max): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
         FROM App\Entity\Produit p
         WHERE p.price >= :min and p.price <= :max
         ORDER BY p.price ASC'
        )->setParameter('min', $min)
        ->setParameter('max', $max);

        // returns an array of Product objects
        return $query->getResult();
    }
    //    public function findOneBySomeField($value): ?Produit
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
