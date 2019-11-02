<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetValueRepository")
 */
class AssetValue implements \JsonSerializable
{
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Asset
     * @ORM\ManyToOne(targetEntity="Asset", inversedBy="values")
     */
    private $asset;

    /**
     * @ORM\Column(type="integer")
     */
    private $valueQB1;

    /**
     * @ORM\Column(type="integer")
     */
    private $valueQB2;

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'assetId' => $this->asset->getId(),
            'valueQB1' => $this->getValueQB1(),
            'valueQB2' => $this->getValueQB2(),
            'date' => $this->getCreatedAt(),
        ];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getValueQB1()
    {
        return $this->valueQB1;
    }

    /**
     * @param mixed $valueQB1
     * @return AssetValue
     */
    public function setValueQB1($valueQB1)
    {
        $this->valueQB1 = $valueQB1;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValueQB2()
    {
        return $this->valueQB2;
    }

    /**
     * @param mixed $valueQB2
     * @return AssetValue
     */
    public function setValueQB2($valueQB2)
    {
        $this->valueQB2 = $valueQB2;
        return $this;
    }

    /**
     * @return Asset
     */
    public function getAsset(): Asset
    {
        return $this->asset;
    }

    /**
     * @param Asset $asset
     * @return AssetValue
     */
    public function setAsset(Asset $asset): AssetValue
    {
        $this->asset = $asset;
        return $this;
    }
}
