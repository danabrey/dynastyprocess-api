<?php

namespace App\Repository;

use App\Entity\ImportedCsv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ImportedCsv|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImportedCsv|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportedCsv[]    findAll()
 * @method ImportedCsv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportedCsvRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ImportedCsv::class);
    }

    public function newDatabaseCsv(string $csv): ImportedCsv
    {
        $importedCsv = new ImportedCsv();
        $importedCsv->setContent($csv);
        $importedCsv->setType(ImportedCsv::TYPE_DATABASE);
        $this->getEntityManager()->persist($importedCsv);
        $this->getEntityManager()->flush();

        return $importedCsv;
    }

    public function newValuesCsv(string $csv): ImportedCsv
    {
        $importedCsv = new ImportedCsv();
        $importedCsv->setContent($csv);
        $importedCsv->setType(ImportedCsv::TYPE_VALUES);
        $this->getEntityManager()->persist($importedCsv);
        $this->getEntityManager()->flush();

        return $importedCsv;
    }

    // /**
    //  * @return ImportedCsv[] Returns an array of ImportedCsv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImportedCsv
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
