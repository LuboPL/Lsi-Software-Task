<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Mapper;

use LsiSoftwareTask\Report\ExportHistory\Criteria\ExportHistoryCriteria;
use LsiSoftwareTask\Report\ExportHistory\Form\ExportHistoryFilter;

final readonly class ExportHistoryCriteriaMapper
{
    public static function fromFilter(ExportHistoryFilter $filter): ExportHistoryCriteria
    {
        return new ExportHistoryCriteria(
            $filter->locationName,
            $filter->exportFrom,
            $filter->exportTo,
        );
    }
}
