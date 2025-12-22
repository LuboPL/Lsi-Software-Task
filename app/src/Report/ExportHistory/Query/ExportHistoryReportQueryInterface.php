<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Query;

use LsiSoftwareTask\Report\ExportHistory\Criteria\ExportHistoryCriteria;
use LsiSoftwareTask\Report\ExportHistory\Entity\ExportHistory;

interface ExportHistoryReportQueryInterface
{
    /**
     * @return array<int, ExportHistory>
     */
    public function fetch(ExportHistoryCriteria $criteria): array;
}
