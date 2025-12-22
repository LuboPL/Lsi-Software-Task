<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Criteria;

use DateTimeImmutable;

final class ExportHistoryCriteria
{
    public ?string $locationName = null;
    public ?DateTimeImmutable $exportFrom = null;
    public ?DateTimeImmutable $exportTo = null;
}
