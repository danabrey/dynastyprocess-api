<?php

namespace App\Command;

use App\Entity\AssetValue;
use App\Repository\AssetRepository;
use App\Repository\AssetValueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class StoreValuesCommand extends Command
{
    protected static $defaultName = 'app:store-values';
    /**
     * @var AssetRepository
     */
    private $assetRepository;
    /**
     * @var AssetValueRepository
     */
    private $assetValueRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(string $name = null, AssetRepository $assetRepository, AssetValueRepository $assetValueRepository, EntityManagerInterface $entityManager)
    {
        parent::__construct($name);
        $this->assetRepository = $assetRepository;
        $this->assetValueRepository = $assetValueRepository;
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Store current player values as AssetValue entities for historical lookup')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $assets = $this->assetRepository->findBy([
            'active' => true,
        ]);
        foreach($assets as $asset) {
            if ($asset->getValueQB1() === null || $asset->getValueQB2() === null) {
                continue;
            }

            $this->assetValueRepository->newFromAsset($asset);
        }
        $this->entityManager->flush();
    }
}
