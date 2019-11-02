<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn("discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "asset" = "Asset",
 *     "player" = "Player",
 *     "exact_pick" = "ExactPick",
 *     "approximate_pick" = "ApproximatePick",
 *     "round_pick" = "RoundPick"
 * })
 */
class Asset implements \JsonSerializable
{

    use TimestampableEntity;

    public function __construct()
    {
        $this->values = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=1, nullable=true)
     */
    private $ecrQB1;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=1, nullable=true)
     */
    private $ecrQB2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $valueQB1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $valueQB2;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mergeName;

    /**
     * @var Collection|AssetValue[]
     * @ORM\OneToMany(targetEntity="AssetValue", mappedBy="asset")
     */
    private $values;

    /**
     * @ORM\Column(type="boolean", options={"default":"1"})
     */
    private $active = true;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEcrQB1()
    {
        return $this->ecrQB1;
    }

    public function setEcrQB1($ecrQB1): self
    {
        $this->ecrQB1 = $ecrQB1;

        return $this;
    }

    public function getValueQB1(): ?int
    {
        return $this->valueQB1;
    }

    public function setValueQB1(?int $valueQB1): self
    {
        $this->valueQB1 = $valueQB1;

        return $this;
    }

    public function getMergeName(): ?string
    {
        return $this->mergeName;
    }

    public function setMergeName(?string $mergeName): self
    {
        $this->mergeName = $mergeName;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getValueQB2(): ?int
    {
        return $this->valueQB2;
    }

    public function setValueQB2(?int $valueQB2): self
    {
        $this->valueQB2 = $valueQB2;

        return $this;
    }

    public function getEcrQB2()
    {
        return $this->ecrQB2;
    }

    public function setEcrQB2($ecrQB2): self
    {
        $this->ecrQB2 = $ecrQB2;

        return $this;
    }

    /**
     * @return AssetValue[]|Collection
     */
    public function getValues()
    {
        return $this->values;
    }

    public function getNameForSelect()
    {
        return trim(sprintf(
            '%s %s %s',
            $this->getMergeName(),
            $this instanceof Player ? $this->getPosition() : '',
            $this instanceof Player ? $this->getTeam() : ''
        ));
    }


    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->getNameForSelect(),
        ];
    }


}
