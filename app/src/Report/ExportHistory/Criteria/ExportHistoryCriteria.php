<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Criteria;

use DateTimeImmutable;

final readonly class ExportHistoryCriteria
{
    public function __construct(
        public ?string $locationName,
        public ?DateTimeImmutable $exportFrom,
        public ?DateTimeImmutable $exportTo,
    ) {
    }
}
