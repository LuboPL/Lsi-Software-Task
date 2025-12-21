<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Criteria;

use DateTimeImmutable;
use LsiSoftwareTask\Report\ExportHistory\Dto\ExportHistoryFilterDTO;

final readonly class ExportHistoryCriteria
{
    private function __construct(
        public ?string $locationName,
        public ?DateTimeImmutable $exportFrom,
        public ?DateTimeImmutable $exportTo
    ) {
    }

    public static function fromFilter(ExportHistoryFilterDTO $dto): self
    {
        return new self(
            $dto->locationName ? trim($dto->locationName) : null,
            $dto->dateFrom?->setTime(0,0,0),
            $dto->dateTo?->setTime(23,59,59)
        );
    }
}
