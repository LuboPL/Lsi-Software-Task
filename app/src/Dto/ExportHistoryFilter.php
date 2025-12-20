<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Dto;

use DateTimeImmutable;

final class ExportHistoryFilter
{
    public ?string $location = null;
    public ?DateTimeImmutable $dateFrom = null;
    public ?DateTimeImmutable $dateTo = null;
}
