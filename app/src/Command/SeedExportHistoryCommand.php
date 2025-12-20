<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Command;

use DateTimeImmutable;
use Doctrine\DBAL\Exception as DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use LsiSoftwareTask\Entity\ExportHistory;
use LsiSoftwareTask\Repository\ExportHistoryRepositoryInterface;
use LsiSoftwareTask\Seed\ExportHistorySeedData;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class SeedExportHistoryCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly ExportHistoryRepositoryInterface $exportHistoryRepository,
    )
    {
        parent::__construct('app:seed-export-history');
    }

    protected function configure(): void
    {
        $this->setDescription('Loads sample export history records.');
    }

    /**
     * @throws DBALException|Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($this->exportHistoryRepository->count([]) > 0) {
            $output->writeln('<comment>Export history already contains data.</comment>');

            return Command::SUCCESS;
        }

        foreach (ExportHistorySeedData::ROWS as [$name, $exportedAt, $user, $location]) {
            $this->entityManager->persist(new ExportHistory(
                $name,
                new DateTimeImmutable($exportedAt),
                $user,
                $location
            ));
        }

        $this->entityManager->flush();

        $output->writeln('<info>Seeded export_history with sample data.</info>');

        return Command::SUCCESS;
    }
}
