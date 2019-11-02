<?php

namespace App\Command;

use App\Service\DynastyProcessDataImporter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DataImportCommand extends Command
{
    /**
     * @var DynastyProcessDataImporter
     */
    private $dataImporter;

    public function __construct(string $name = null, DynastyProcessDataImporter $dataImporter)
    {
        parent::__construct($name);
        $this->dataImporter = $dataImporter;
    }

    protected static $defaultName = 'app:data-import';

    protected function configure()
    {
        $this
            ->setDescription('Import new database and values data from DynastyProcess.com CSVs')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $this->dataImporter->importDatabaseCsv();
        $this->dataImporter->importValuesCsv();
    }
}
