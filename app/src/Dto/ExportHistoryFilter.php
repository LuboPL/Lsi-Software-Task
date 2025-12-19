<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Dto;

use DateTimeImmutable;

final readonly class ExportHistoryFilter
{
    public function __construct(
        public ?string $location = null,
        public ?DateTimeImmutable $dateFrom = null,
        public ?DateTimeImmutable $dateTo = null
    ) {
    }
}
