<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Repository;

use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use LsiSoftwareTask\Entity\ExportHistory;

final class ExportHistoryRepository extends ServiceEntityRepository implements ExportHistoryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExportHistory::class);
    }

    /**
     * @return ExportHistory[]
     */
    public function findByLocalAndDateRange(
        ?string $locationName,
        ?DateTimeImmutable $exportedFrom,
        ?DateTimeImmutable $exportedTo
    ): array {
        $qb = $this->createQueryBuilder('e')
            ->orderBy('e.exportedAt', 'DESC');

        $locationName = trim(($locationName ?? ''));
        if ($locationName !== '') {
            $qb->andWhere('e.locationName = :locationName')
                ->setParameter('locationName', $locationName);
        }

        if ($exportedFrom instanceof DateTimeImmutable) {
            $qb->andWhere('e.exportedAt >= :exportedFrom')
                ->setParameter('exportedFrom', $exportedFrom->setTime(0, 0, 0));
        }

        if ($exportedTo instanceof DateTimeImmutable) {
            $qb->andWhere('e.exportedAt <= :exportedTo')
                ->setParameter('exportedTo', $exportedTo->setTime(23, 59, 59));
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @return string[]
     */
    public function getDistinctLocations(): array
    {
        $rows = $this->createQueryBuilder('e')
            ->select('DISTINCT e.locationName AS locationName')
            ->orderBy('e.locationName', 'ASC')
            ->getQuery()
            ->getScalarResult();

        return array_column($rows, 'locationName');
    }
}
