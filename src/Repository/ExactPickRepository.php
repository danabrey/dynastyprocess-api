<?php

namespace App\Repository;

use App\Entity\ExactPick;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ExactPick|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExactPick|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExactPick[]    findAll()
 * @method ExactPick[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExactPickRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ExactPick::class);
    }

    public function findOrCreate(string $mergeName, int $year, int $number): ExactPick
    {
        $pick = $this->findByYearAndNumber($year, $number);
        if (!$pick) {
            $pick = new ExactPick();
            $pick->setMergeName($mergeName);
            $pick->setYear($year);
            $pick->setNumber($number);
            $this->getEntityManager()->persist($pick);
            $this->getEntityManager()->flush();
        }
        return $pick;
    }

    public function findByYearAndNumber(int $year, int $number)
    {
        return $this->findOneBy([
            'year' => $year,
            'number' => $number,
        ]);
    }

    // /**
    //  * @return ExactPick[] Returns an array of ExactPick objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ExactPick
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
