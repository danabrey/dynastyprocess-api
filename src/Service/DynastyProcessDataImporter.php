<?php
namespace App\Service;

use App\Entity\ApproximatePick;
use App\Entity\Asset;
use App\Entity\ExactPick;
use App\Entity\Player;
use App\Entity\RoundPick;
use App\Repository\ImportedCsvRepository;
use App\Repository\PlayerRepository;
use App\Util\CSV;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Cache\Adapter\AdapterInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DynastyProcessDataImporter
{
    private const DATABASE_CSV_URL = 'https://github.com/tanho63/dynastyprocess/raw/master/files/database.csv';
    private const VALUES_CSV_URL = 'https://github.com/tanho63/dynastyprocess/raw/master/files/values.csv';
    /**
     * @var ImportedCsvRepository
     */
    private $importedCsvRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var PlayerRepository
     */
    private $playerRepository;
    /**
     * @var AdapterInterface
     */
    private $cache;

    /**
     * DynastyProcessDataImporter constructor.
     * @param ImportedCsvRepository $importedCsvRepository
     * @param PlayerRepository $playerRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(ImportedCsvRepository $importedCsvRepository, PlayerRepository $playerRepository, EntityManagerInterface $entityManager, AdapterInterface $cache)
    {
        $this->importedCsvRepository = $importedCsvRepository;
        $this->entityManager = $entityManager;
        $this->playerRepository = $playerRepository;
        $this->cache = $cache;
    }

    private function fetchDatabaseCsv(): string
    {
        $csv = file_get_contents(self::DATABASE_CSV_URL);
        $csv = CSV::removeBOM($csv);
        return $csv;
    }

    public function importDatabaseCsv()
    {
        $csv = $this->fetchDatabaseCsv();

        $entity = $this->importedCsvRepository->newDatabaseCsv($csv);
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        $data = $serializer->decode($csv, 'csv');

        $gsisIDs = [];
        foreach($data as $row) {
            $gsisIDs[] = $row['gsis_id'];

            if (!isset($row['mergename']) || !isset($row['pos']) || !isset($row['name']) || $row['name'] === '') {
                continue;
            }

            $player = $this->playerRepository->findOneBy([
                'gsisId' => $row['gsis_id'],
            ]);
            if (!$player) {
                $player = new Player();
                $player->setGsisId($row['gsis_id']);
                $this->entityManager->persist($player);
            }

            $this->setPlayerPropertiesFromRow($player, $row);

            $player->setActive(true);
        }

        // Any player not in database.csv but in our database, mark as inactive
        $players = $this->playerRepository->findAll();
        foreach($players as $player) {
            if (!in_array($player->getGsisId(), $gsisIDs, true)) {
                $player->setActive(false);
            }
        }

        $this->entityManager->flush();
    }

    // TODO: Replace with denormalizer
    private function setPlayerPropertiesFromRow(Player $player, array $row): void
    {
        // Convert empty string values, and 'NA', to null
        foreach($row as $k => &$v) {
            if ($v === '' || $v === 'NA') {
                $v = null;
            }
        }
        unset($v);

        $player->setMergeName($row['mergename']);
        $player->setName($row['name']);
        $player->setFirstName($row['first_name']);
        $player->setLastName($row['last_name']);

        $player->setPosition($row['pos']);
        $player->setTeam($row['team']);
        $player->setAge($row['age']);
        $player->setHeight($row['height']);
        $player->setWeight($row['weight']);

        $player->setSalaryAverage($row['salary_avg']);
        $player->setFreeAgencyYear($row['fa_year']);

        $player->setEcrSD($row['dynoSD']);
        $player->setEcrPositional($row['dynpECR']);
        $player->setEcrPositionalSD($row['dynpSD']);
        $player->setEcrRedraftPositional($row['rdpECR']);
        $player->setEcrRedraftPositionalSD($row['rdpSD']);

        $player->setCollege($row['college']);
        $player->setDraftYear($row['draft_year']);
        $player->setDraftRound($row['draft_round']);
        $player->setDraftPick($row['draft_pick']);
        $player->setDraftRookieADP($row['draft_rookieadp']);
        $player->setDraftRookieADP2QB($row['draft_2QBrookieadp']);

        $player->setArmLength($row['armLength']);
        $player->setHandSize($row['handsize']);
        $player->setFortyYardDash($row['forty']);
        $player->setTwentySplit($row['twenty-split']);
        $player->setTenSplit($row['ten-split']);
        $player->setBenchPress($row['bench']);
        $player->setVertical($row['vertical']);
        $player->setBroadJump($row['broad']);
        $player->setShuttle($row['shuttle']);
        $player->setThreeConeDrill($row['cone']);
        $player->setRelativeAthleticScore($row['RAS']);

        $player->setThirdPartyIdPFR($row['pfr_id']);
        $player->setThirdPartyIdMFL($row['mfl_id']);
        $player->setThirdPartyIdSleeper($row['sleeper_id']);
        $player->setThirdPartyIdFantasyData($row['fantasy_data_id']);
        $player->setThirdPartyIdRotowire($row['rotowire_id']);
        $player->setThirdPartyIdSportradar($row['sportradar_id']);
        $player->setThirdPartyIdRotoworld($row['rotoworld_id']);
        $player->setThirdPartyIdYahoo($row['yahoo_id']);
        $player->setThirdPartyIdESPN($row['espn_id']);
        $player->setThirdPartyIdStats($row['stats_id']);
    }

    private function fetchValuesCsv(): string
    {
        $csv = file_get_contents(self::VALUES_CSV_URL);
        $csv = CSV::removeBOM($csv);
        return $csv;
    }

    public function importValuesCsv()
    {
        $csv = $this->fetchValuesCsv();

        $entity = $this->importedCsvRepository->newValuesCsv($csv);
        $serializer = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        $data = $serializer->decode($csv, 'csv');

        $processedPickIds = [];
        foreach($data as $row) {
            if ($row['pos'] !== 'PICK') {
                // It's a player
                $asset = $this->playerRepository->findOneBy([
                    'mergeName' => $row['mergename'],
                    'team' => $row['team'],
                    'position' => $row['pos'],
                ]);
            } else {
                // It's a pick. Identify whether it's an exact, approximate or round pick
                $asset = $this->findOrCreatePickFromRow($row);
                $processedPickIds[] = $asset->getId();
            }
            if (!$asset) {
                // TODO: why is Josh Jacobs breaking this?
                continue;
            }

            $asset->setValueQB1($row['1QBValue'] !== '' ? $row['1QBValue'] : 0);
            $asset->setValueQB2($row['2QB Value'] !== '' ? $row['2QB Value'] : 0);
            $asset->setEcrQB1($row['dynoECR'] !== '' ? $row['dynoECR'] : 0);
            $asset->setEcrQB2($row['dyno2QBECR'] !== '' ? $row['dyno2QBECR'] : 0);
        }

        // TODO: Mark inactive picks as inactive - loop over all picks and if they haven't been processed by the above, set as inactive
        $qb = $this->entityManager->getRepository(Asset::class)->createQueryBuilder('a');
        $pickClasses = [
            ExactPick::class,
            RoundPick::class,
            ApproximatePick::class,
        ];
        foreach($pickClasses as $pickClass) {
            $qb->orWhere('a INSTANCE OF ' . $pickClass);
        }
        $allPicks = $qb->getQuery()->getResult();

        /** @var Asset $pick */
        foreach($allPicks as $pick) {
            if (!in_array($pick->getId(), $processedPickIds, true)) {
                $pick->setActive(false);
            }
        }
        $this->entityManager->flush();
    }

    private function findOrCreatePickFromRow(array $row): Asset
    {
        // Exact = 2019 Pick 48             inclusion of word 'Pick'
        // Approximate = 2020 Late 4th      inclusion of word 'Early', 'Mid' or 'Late'
        // Round = 2021 4th                 lack of either of those words
        $parts = explode(' ', $row['mergename']);

        if ($parts[1] === 'Pick') {
            $pick = $this->entityManager->getRepository(ExactPick::class)->findOrCreate($row['mergename'], $parts[0], $parts[2]);
        } elseif (in_array($parts[1], ApproximatePick::TIERS, true)) {
            $tier = array_search($parts[1], ApproximatePick::TIERS, true);
            $pick = $this->entityManager->getRepository(ApproximatePick::class)->findOrCreate($row['mergename'], $parts[0], $parts[2][0], $tier);
        } else {
            $pick = $this->entityManager->getRepository(RoundPick::class)->findOrCreate($row['mergename'], $parts[0], $parts[1][0]);
        }

        return $pick;
    }
}
