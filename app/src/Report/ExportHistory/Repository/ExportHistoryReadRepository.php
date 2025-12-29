<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\ManagerRegistry;
use LsiSoftwareTask\Report\ExportHistory\Criteria\ExportHistoryCriteria;
use LsiSoftwareTask\Report\ExportHistory\Entity\ExportHistory;

/**
 * @extends ServiceEntityRepository<ExportHistory>
 */
final class ExportHistoryReadRepository extends ServiceEntityRepository implements ExportHistoryReadRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExportHistory::class);
    }

    public function findByCriteria(ExportHistoryCriteria $criteria): array
    {
        $locationName = $criteria->locationName;
        $exportFrom = $criteria->exportFrom;
        $exportTo = $criteria->exportTo;

        $qb = $this->createQueryBuilder('e')
            ->orderBy('e.exportedAt', 'DESC')
            ->setMaxResults($criteria->limit)
            ->setFirstResult($criteria->offset);

        if ($locationName) {
            $qb->andWhere('e.locationName = :locationName')
                ->setParameter('locationName', $locationName, Types::STRING);
        }

        if ($exportFrom !== null) {
            $qb->andWhere('e.exportedAt >= :exportedFrom')
                ->setParameter('exportedFrom', $exportFrom, Types::DATETIME_IMMUTABLE);
        }

        if ($exportTo !== null) {
            $qb->andWhere('e.exportedAt <= :exportedTo')
                ->setParameter('exportedTo', $exportTo, Types::DATETIME_IMMUTABLE);
        }

        return $qb->getQuery()->getResult();
    }

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
