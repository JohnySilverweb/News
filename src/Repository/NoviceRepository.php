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
        ->where('LOWER(t.name) LIKE LOWER(:search)')
        ->orWhere('LOWER(t.category) LIKE LOWER(:search)')
        ->orWhere('LOWER(t.content) LIKE LOWER(:search)')
        ->setParameter('search', '%' . $search . '%') 
        ->getQuery()
        ->getResult();
    }

    public function duplicateNews($id)
    {
        $news = $this->find($id);

        $newsCopy = new Novice();
        $newsCopy->setName($news->getName());
        $newsCopy->setCategory($news->getCategory());
        $newsCopy->setSummary($news->getSummary());
        $newsCopy->setContent($news->getContent());
        $newsCopy->setValidFrom(new \DateTime());
        $newsCopy->setValidTill(new \DateTime());
        $newsCopy->setCreatedAt(new \DateTime());
        $newsCopy->setUpdatedAt(new \DateTime());
        $newsCopy->setFeatured($news->IsFeatured());
        $newsCopy->setPublished($news->IsPublished());

        $this->getEntityManager()->persist($newsCopy);
        $this->getEntityManager()->flush();

        return $newsCopy->getId();
    }

    public function seePublished(): array 
    {
        return $this->createQueryBuilder('t')
        ->where('t.published = :published')
        ->setParameter('published', true)
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
