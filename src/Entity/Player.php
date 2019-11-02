<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlayerRepository")
 */
class Player extends Asset
{
    /**
     * @ORM\Column(type="string", length=5)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gsisId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $team;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ecrSD;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ecrPositional;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ecrPositionalSD;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ecrRedraftPositional;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ecrRedraftPositionalSD;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=1, nullable=true)
     */
    private $age;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $salaryAverage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $freeAgencyYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $draftYear;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $draftRound;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $draftPick;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $draftRookieADP;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $draftRookieADP2QB;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $college;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $height;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     */
    private $armLength;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=3, nullable=true)
     */
    private $handSize;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $fortyYardDash;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $twentySplit;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $tenSplit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $benchPress;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $vertical;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $broadJump;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $shuttle;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $threeConeDrill;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $relativeAthleticScore;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdPartyIdPFR;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdPartyIdMFL;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdPartyIdSleeper;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdPartyIdFantasyData;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdPartyIdRotowire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdPartyIdSportradar;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdPartyIdYahoo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdPartyIdESPN;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdPartyIdStats;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thirdPartyIdRotoworld;

    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string $position
     * @return Player
     */
    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getGsisId(): ?string
    {
        return $this->gsisId;
    }

    /**
     * @param string $gsisId
     * @return Player
     */
    public function setGsisId(string $gsisId): self
    {
        $this->gsisId = $gsisId;

        return $this;
    }

    public function getTeam(): ?string
    {
        return $this->team;
    }

    public function setTeam(?string $team): self
    {
        $this->team = $team;

        return $this;
    }

    public function getEcrSD()
    {
        return $this->ecrSD;
    }

    public function setEcrSD($ecrSD): self
    {
        $this->ecrSD = $ecrSD;

        return $this;
    }

    public function getEcrPositional()
    {
        return $this->ecrPositional;
    }

    public function setEcrPositional($ecrPositional): self
    {
        $this->ecrPositional = $ecrPositional;

        return $this;
    }

    public function getEcrPositionalSD()
    {
        return $this->ecrPositionalSD;
    }

    public function setEcrPositionalSD($ecrPositionalSD): self
    {
        $this->ecrPositionalSD = $ecrPositionalSD;

        return $this;
    }

    public function getEcrRedraftPositional()
    {
        return $this->ecrRedraftPositional;
    }

    public function setEcrRedraftPositional($ecrRedraftPositional): self
    {
        $this->ecrRedraftPositional = $ecrRedraftPositional;

        return $this;
    }

    public function getEcrRedraftPositionalSD()
    {
        return $this->ecrRedraftPositionalSD;
    }

    public function setEcrRedraftPositionalSD($ecrRedraftPositionalSD): self
    {
        $this->ecrRedraftPositionalSD = $ecrRedraftPositionalSD;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getSalaryAverage()
    {
        return $this->salaryAverage;
    }

    public function setSalaryAverage($salaryAverage): self
    {
        $this->salaryAverage = $salaryAverage;

        return $this;
    }

    public function getFreeAgencyYear(): ?int
    {
        return $this->freeAgencyYear;
    }

    public function setFreeAgencyYear(?int $freeAgencyYear): self
    {
        $this->freeAgencyYear = $freeAgencyYear;

        return $this;
    }

    public function getDraftYear(): ?int
    {
        return $this->draftYear;
    }

    public function setDraftYear(?int $draftYear): self
    {
        $this->draftYear = $draftYear;

        return $this;
    }

    public function getDraftRound(): ?int
    {
        return $this->draftRound;
    }

    public function setDraftRound(?int $draftRound): self
    {
        $this->draftRound = $draftRound;

        return $this;
    }

    public function getDraftPick(): ?int
    {
        return $this->draftPick;
    }

    public function setDraftPick(?int $draftPick): self
    {
        $this->draftPick = $draftPick;

        return $this;
    }

    public function getDraftRookieADP(): ?int
    {
        return $this->draftRookieADP;
    }

    public function setDraftRookieADP(?int $draftRookieADP): self
    {
        $this->draftRookieADP = $draftRookieADP;

        return $this;
    }

    public function getDraftRookieADP2QB(): ?int
    {
        return $this->draftRookieADP2QB;
    }

    public function setDraftRookieADP2QB(?int $draftRookieADP2QB): self
    {
        $this->draftRookieADP2QB = $draftRookieADP2QB;

        return $this;
    }

    public function getCollege(): ?string
    {
        return $this->college;
    }

    public function setCollege(?string $college): self
    {
        $this->college = $college;

        return $this;
    }

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getArmLength()
    {
        return $this->armLength;
    }

    public function setArmLength($armLength): self
    {
        $this->armLength = $armLength;

        return $this;
    }

    public function getHandSize()
    {
        return $this->handSize;
    }

    public function setHandSize($handSize): self
    {
        $this->handSize = $handSize;

        return $this;
    }

    public function getFortyYardDash()
    {
        return $this->fortyYardDash;
    }

    public function setFortyYardDash($fortyYardDash): self
    {
        $this->fortyYardDash = $fortyYardDash;

        return $this;
    }

    public function getTwentySplit()
    {
        return $this->twentySplit;
    }

    public function setTwentySplit($twentySplit): self
    {
        $this->twentySplit = $twentySplit;

        return $this;
    }

    public function getTenSplit()
    {
        return $this->tenSplit;
    }

    public function setTenSplit($tenSplit): self
    {
        $this->tenSplit = $tenSplit;

        return $this;
    }

    public function getBenchPress()
    {
        return $this->benchPress;
    }

    public function setBenchPress($benchPress): self
    {
        $this->benchPress = $benchPress;

        return $this;
    }

    public function getVertical()
    {
        return $this->vertical;
    }

    public function setVertical($vertical): self
    {
        $this->vertical = $vertical;

        return $this;
    }

    public function getBroadJump()
    {
        return $this->broadJump;
    }

    public function setBroadJump($broadJump): self
    {
        $this->broadJump = $broadJump;

        return $this;
    }

    public function getShuttle()
    {
        return $this->shuttle;
    }

    public function setShuttle($shuttle): self
    {
        $this->shuttle = $shuttle;

        return $this;
    }

    public function getThreeConeDrill()
    {
        return $this->threeConeDrill;
    }

    public function setThreeConeDrill($threeConeDrill): self
    {
        $this->threeConeDrill = $threeConeDrill;

        return $this;
    }

    public function getRelativeAthleticScore()
    {
        return $this->relativeAthleticScore;
    }

    public function setRelativeAthleticScore($relativeAthleticScore): self
    {
        $this->relativeAthleticScore = $relativeAthleticScore;

        return $this;
    }

    public function getThirdPartyIdPFR(): ?string
    {
        return $this->thirdPartyIdPFR;
    }

    public function setThirdPartyIdPFR(?string $thirdPartyIdPFR): self
    {
        $this->thirdPartyIdPFR = $thirdPartyIdPFR;

        return $this;
    }

    public function getThirdPartyIdMFL(): ?string
    {
        return $this->thirdPartyIdMFL;
    }

    public function setThirdPartyIdMFL(?string $thirdPartyIdMFL): self
    {
        $this->thirdPartyIdMFL = $thirdPartyIdMFL;

        return $this;
    }

    public function getThirdPartyIdSleeper(): ?string
    {
        return $this->thirdPartyIdSleeper;
    }

    public function setThirdPartyIdSleeper(?string $thirdPartyIdSleeper): self
    {
        $this->thirdPartyIdSleeper = $thirdPartyIdSleeper;

        return $this;
    }

    public function getThirdPartyIdFantasyData(): ?string
    {
        return $this->thirdPartyIdFantasyData;
    }

    public function setThirdPartyIdFantasyData(?string $thirdPartyIdFantasyData): self
    {
        $this->thirdPartyIdFantasyData = $thirdPartyIdFantasyData;

        return $this;
    }

    public function getThirdPartyIdRotowire(): ?string
    {
        return $this->thirdPartyIdRotowire;
    }

    public function setThirdPartyIdRotowire(?string $thirdPartyIdRotowire): self
    {
        $this->thirdPartyIdRotowire = $thirdPartyIdRotowire;

        return $this;
    }

    public function getThirdPartyIdSportradar(): ?string
    {
        return $this->thirdPartyIdSportradar;
    }

    public function setThirdPartyIdSportradar(?string $thirdPartyIdSportradar): self
    {
        $this->thirdPartyIdSportradar = $thirdPartyIdSportradar;

        return $this;
    }

    public function getThirdPartyIdYahoo(): ?string
    {
        return $this->thirdPartyIdYahoo;
    }

    public function setThirdPartyIdYahoo(?string $thirdPartyIdYahoo): self
    {
        $this->thirdPartyIdYahoo = $thirdPartyIdYahoo;

        return $this;
    }

    public function getThirdPartyIdESPN(): ?string
    {
        return $this->thirdPartyIdESPN;
    }

    public function setThirdPartyIdESPN(?string $thirdPartyIdESPN): self
    {
        $this->thirdPartyIdESPN = $thirdPartyIdESPN;

        return $this;
    }

    public function getThirdPartyIdStats(): ?string
    {
        return $this->thirdPartyIdStats;
    }

    public function setThirdPartyIdStats(?string $thirdPartyIdStats): self
    {
        $this->thirdPartyIdStats = $thirdPartyIdStats;

        return $this;
    }

    public function getThirdPartyIdRotoworld(): ?string
    {
        return $this->thirdPartyIdRotoworld;
    }

    public function setThirdPartyIdRotoworld(?string $thirdPartyIdRotoworld): self
    {
        $this->thirdPartyIdRotoworld = $thirdPartyIdRotoworld;

        return $this;
    }
}
