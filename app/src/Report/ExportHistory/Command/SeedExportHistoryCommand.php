<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Command;

use DateTimeImmutable;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use LsiSoftwareTask\Report\ExportHistory\Entity\ExportHistory;
use LsiSoftwareTask\Report\ExportHistory\Seed\ExportHistorySeedData;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

final class SeedExportHistoryCommand extends Command
{
    private const string SEED_EXISTS_MESSAGE = '<comment>Export history already contains data.</comment>';
    private const string SEEDED_MESSAGE = '<info>Seeded export_history with sample data.</info>';
    private const string ERROR_MESSAGE_TEMPLATE = '<error>Error seeding export_history: %s</error>';
    private const string COMMAND_NAME = 'app:seed-export-history';
    private const string COMMAND_DESCRIPTION = 'Loads sample export history records.';

    public function __construct(
        private readonly Connection $connection,
        private readonly EntityManagerInterface $entityManager,
    )
    {
        parent::__construct(self::COMMAND_NAME);
    }

    protected function configure(): void
    {
        $this->setDescription(self::COMMAND_DESCRIPTION);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $exists = (bool) $this->connection->fetchOne('SELECT 1 FROM export_history LIMIT 1');

            if ($exists) {
                $output->writeln(self::SEED_EXISTS_MESSAGE);

                return Command::SUCCESS;
            }

            foreach (ExportHistorySeedData::ROWS as [$name, $exportedAt, $user, $locationName]) {
                $this->entityManager->persist(
                    new ExportHistory(
                        $name,
                        DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $exportedAt),
                        $user,
                        $locationName
                    )
                );
            }
            $this->entityManager->flush();
            $output->writeln(self::SEEDED_MESSAGE);
        } catch (Throwable $e) {
            $output->writeln(
                sprintf(
                    self::ERROR_MESSAGE_TEMPLATE,
                    $e->getMessage()
                )
            );

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
