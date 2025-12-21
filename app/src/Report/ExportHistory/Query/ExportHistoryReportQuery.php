<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Query;

use LsiSoftwareTask\Report\ExportHistory\Criteria\ExportHistoryCriteria;
use LsiSoftwareTask\Report\ExportHistory\Dto\ExportHistoryFilterDTO;
use LsiSoftwareTask\Report\ExportHistory\Repository\ExportHistoryReadRepositoryInterface;

final readonly class ExportHistoryReportQuery implements ExportHistoryReportQueryInterface
{
    public function __construct(
        private ExportHistoryReadRepositoryInterface $exportHistoryReadRepository,
    ) {
    }

    public function fetch(ExportHistoryFilterDTO $filter): array
    {
        $criteria = ExportHistoryCriteria::fromFilter($filter);

        return $this->exportHistoryReadRepository->findByCriteria($criteria);
    }
}
