<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Dto;

use DateTimeImmutable;

final class ExportHistoryFilter
{
    public ?string $locationName = null;
    public ?DateTimeImmutable $dateFrom = null;
    public ?DateTimeImmutable $dateTo = null;
}
