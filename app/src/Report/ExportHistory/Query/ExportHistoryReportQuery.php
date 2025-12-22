<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Query;

use LsiSoftwareTask\Report\ExportHistory\Criteria\ExportHistoryCriteria;
use LsiSoftwareTask\Report\ExportHistory\Repository\ExportHistoryReadRepositoryInterface;

final readonly class ExportHistoryReportQuery implements ExportHistoryReportQueryInterface
{
    public function __construct(
        private ExportHistoryReadRepositoryInterface $exportHistoryReadRepository,
    ) {
    }

    public function fetch(ExportHistoryCriteria $criteria): array
    {
        return $this->exportHistoryReadRepository->findByCriteria($criteria);
    }
}
