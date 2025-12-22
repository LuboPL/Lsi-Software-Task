<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Criteria;

use DateTimeImmutable;

final class ExportHistoryCriteria
{
    public ?string $locationName = null;
    public ?DateTimeImmutable $exportFrom = null;
    public ?DateTimeImmutable $exportTo = null;

    public function normalize(): void
    {
        if ($this->locationName !== null) {
            $locationName = trim($this->locationName);
            $this->locationName = $locationName !== '' ? $locationName : null;
        }

        if ($this->exportFrom !== null) {
            $this->exportFrom = $this->exportFrom->setTime(0, 0, 0);
        }

        if ($this->exportTo !== null) {
            $this->exportTo = $this->exportTo->setTime(23, 59, 59);
        }
    }
}
