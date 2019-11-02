<?php

namespace App\Repository;

use App\Entity\ApproximatePick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ApproximatePick|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApproximatePick|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApproximatePick[]    findAll()
 * @method ApproximatePick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ApproximatePickRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ApproximatePick::class);
    }

    public function findOrCreate(string $mergeName, int $year, int $round, int $tier): ApproximatePick
    {
        $pick = $this->findByYearRoundAndTier($year, $round, $tier);
        if (!$pick) {
            $pick = new ApproximatePick();
            $pick->setMergeName($mergeName);
            $pick->setYear($year);
            $pick->setRound($round);
            $pick->setTier($tier);
            $this->getEntityManager()->persist($pick);
            $this->getEntityManager()->flush();
        }
        return $pick;
    }

    public function findByYearRoundAndTier(int $year, int $round, int $tier)
    {
        return $this->findOneBy([
            'year' => $year,
            'round' => $round,
            'tier' => $tier,
        ]);
    }

    // /**
    //  * @return ApproximatePick[] Returns an array of ApproximatePick objects
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
    public function findOneBySomeField($value): ?ApproximatePick
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
