<?php

namespace App\Repository;

use App\Entity\RoundPick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RoundPick|null find($id, $lockMode = null, $lockVersion = null)
 * @method RoundPick|null findOneBy(array $criteria, array $orderBy = null)
 * @method RoundPick[]    findAll()
 * @method RoundPick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RoundPickRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RoundPick::class);
    }

    public function findOrCreate(string $mergeName, int $year, int $round): RoundPick
    {
        $pick = $this->findByYearAndRound($year, $round);
        if (!$pick) {
            $pick = new RoundPick();
            $pick->setMergeName($mergeName);
            $pick->setYear($year);
            $pick->setRound($round);
            $this->getEntityManager()->persist($pick);
            $this->getEntityManager()->flush();
        }
        return $pick;
    }

    public function findByYearAndRound(int $year, int $round)
    {
        return $this->findOneBy([
            'year' => $year,
            'round' => $round,
        ]);
    }

    // /**
    //  * @return RoundPick[] Returns an array of RoundPick objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RoundPick
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
