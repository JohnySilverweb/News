<?php

namespace App\Repository;

use App\Entity\Novice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Novice>
 */
class NoviceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Novice::class);
    }

    public function searchNews(?string $search): array {
        return $this->createQueryBuilder('t')
        ->where('LOWER(t.Naziv) LIKE LOWER(:search)')
        ->orWhere('LOWER(t.Kategorija) LIKE LOWER(:search)')
        ->orWhere('LOWER(t.Vsebina) LIKE LOWER(:search)')
        ->setParameter('search', '%' . $search . '%') 
        ->getQuery()
        ->getResult();
    }










//    /**
//     * @return Novice[] Returns an array of Novice objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Novice
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
