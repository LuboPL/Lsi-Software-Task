<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Query;

use LsiSoftwareTask\Report\ExportHistory\Dto\ExportHistoryFilterDTO;

interface ExportHistoryReportQueryInterface
{
    public function fetch(ExportHistoryFilterDTO $filter): array;
}
