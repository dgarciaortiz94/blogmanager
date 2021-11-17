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
     * @return Podcast Returns an array of Podcast objects
     */
    public function findAllActives()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.isActive = 1')
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @return Podcast[] Returns an array of Podcast objects
     */
    public function getByUser($userId)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.isActive = 1')
            ->andWhere('p.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @return Podcast[] Returns an array of Podcast objects
     */
    public function getLastPodcasts($numberOfPodcasts)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.isActive = 1')
            ->orderBy('p.createDate', 'DESC')
            ->getQuery()
            ->setMaxResults($numberOfPodcasts)
            ->getResult()
        ;
    }


    /**
     * @return Podcast Returns an array of Podcast objects
     */
    public function getOneByTitle($title)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.title = :title')
            ->setParameter('title', $title)
            ->andWhere('p.isActive = 1')
            ->getQuery()
            ->getSingleResult()
        ;
    }


    /**
     * @return Podcast Returns an array of Podcast objects
     */
    public function getMostCommentedPodcast($title)
    {
        $em = $this->getEntityManager();

        return $em->createQuery("SELECT COUNT(USER_ID)")
        ;
    }
}
