<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApproximatePickRepository")
 */
class ApproximatePick extends Asset
{
    public const TIERS = [
        'Early',
        'Mid',
        'Late',
    ];

    private const TIER_EARLY = 0;
    private const TIER_MID = 1;
    private const TIER_LATE = 2;

    public const TIER_LABELS = [
        self::TIER_EARLY => 'Early',
        self::TIER_MID => 'Mid',
        self::TIER_LATE => 'Late',
    ];

    /**
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\Column(type="integer")
     */
    private $round;

    /**
     * @ORM\Column(type="integer")
     */
    private $tier;

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getRound(): ?int
    {
        return $this->round;
    }

    public function setRound(int $round): self
    {
        $this->round = $round;

        return $this;
    }

    public function getTier(): ?int
    {
        return $this->tier;
    }

    public function setTier(int $tier): self
    {
        $this->tier = $tier;

        return $this;
    }
}
