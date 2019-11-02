<?php

namespace App\Repository;

use App\Entity\Asset;
use App\Entity\AssetValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AssetValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method AssetValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method AssetValue[]    findAll()
 * @method AssetValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssetValueRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AssetValue::class);
    }

    public function newFromAsset(Asset $asset)
    {
        $assetValue = new AssetValue();
        $assetValue->setAsset($asset);
        $assetValue->setValueQB1($asset->getValueQB1());
        $assetValue->setValueQB2($asset->getValueQB2());
        $this->getEntityManager()->persist($assetValue);
    }
}
