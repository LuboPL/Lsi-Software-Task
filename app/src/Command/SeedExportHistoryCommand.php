<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Command;

use DateMalformedStringException;
use DateTimeImmutable;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use LsiSoftwareTask\Entity\ExportHistory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class SeedExportHistoryCommand extends Command
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        parent::__construct('app:seed-export-history');
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Loads sample export history records.')
            ->addOption(
                'truncate',
                null,
                InputOption::VALUE_NONE,
                'Delete existing rows before seeding'
            );
    }

    /**
     * @throws Exception|DateMalformedStringException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $truncate = (bool) $input->getOption('truncate');
        $repository = $this->entityManager->getRepository(ExportHistory::class);

        if ($truncate) {
            $this->entityManager->getConnection()->executeStatement('TRUNCATE TABLE export_history');
        } elseif ($repository->count([]) > 0) {
            $output->writeln('<comment>Export history already contains data. Use --truncate to reseed.</comment>');

            return Command::SUCCESS;
        }

        $rows = [
            ['inventory', '2024-12-10 08:15:00', 'system', 'Tychy'],
            ['orders', '2024-12-12 14:05:00', 'admin', 'Katowice'],
            ['clients', '2024-12-14 09:30:00', 'reporter', 'Łódź'],
            ['returns', '2024-12-15 16:45:00', 'system', 'Warszawa'],
            ['payments', '2024-12-18 07:20:00', 'analyst', 'Kraków'],
        ];

        foreach ($rows as [$name, $exportedAt, $user, $location]) {
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
