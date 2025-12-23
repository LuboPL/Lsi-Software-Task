<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Form;

use DateTimeImmutable;

final class ExportHistoryFilter
{
    public ?string $locationName = null;
    public ?DateTimeImmutable $exportFrom = null;
    public ?DateTimeImmutable $exportTo = null;
}
