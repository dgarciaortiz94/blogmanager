<?php

namespace App\Repository;

use App\Entity\Podcast;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Podcast|null find($id, $lockMode = null, $lockVersion = null)
 * @method Podcast|null findOneBy(array $criteria, array $orderBy = null)
 * @method Podcast[]    findAll()
 * @method Podcast[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PodcastRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Podcast::class);
    }


    /**
     * @return Podcast[] Returns an array of Podcast objects
     */
    public function getByUser($userId)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Podcast p
            WHERE p.user = :userId
            ORDER BY p.createDate ASC'
        )->setParameter('userId', $userId);

        return $query->getResult();
    }


    /**
     * @return Podcast[] Returns an array of Podcast objects
     */
    public function getLastPodcasts($numberOfPodcasts)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\Podcast p
            ORDER BY p.createDate DESC'
        )->setMaxResults($numberOfPodcasts);

        return $query->getResult();
    }


    // /**
    //  * @return Podcast[] Returns an array of Podcast objects
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
    public function findOneBySomeField($value): ?Podcast
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
