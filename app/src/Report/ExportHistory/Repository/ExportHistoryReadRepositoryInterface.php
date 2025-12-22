<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Repository;

use LsiSoftwareTask\Report\ExportHistory\Criteria\ExportHistoryCriteria;
use LsiSoftwareTask\Report\ExportHistory\Entity\ExportHistory;

interface ExportHistoryReadRepositoryInterface
{
    /**
     * @return array<int, ExportHistory>
     */
    public function findByCriteria(ExportHistoryCriteria $criteria): array;

    /**
     * @return array<int, string>
     */
    public function getDistinctLocations(): array;
}
