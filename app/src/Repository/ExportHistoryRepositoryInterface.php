<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Repository;

use DateTimeImmutable;
use LsiSoftwareTask\Entity\ExportHistory;

interface ExportHistoryRepositoryInterface
{
    /**
     * @return ExportHistory[]
     */
    public function findByLocalAndDateRange(
        ?string $locationName,
        ?DateTimeImmutable $exportedFrom,
        ?DateTimeImmutable $exportedTo
    ): array;

    /**
     * @return string[]
     */
    public function getDistinctLocations(): array;
}
