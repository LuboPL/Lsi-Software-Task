<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Entity;

use DateTimeImmutable;

class ExportHistory
{
    private ?int $id = null;

    public function __construct(
        private string $exportName,
        private DateTimeImmutable $exportedAt,
        private string $exportedByUsername,
        private string $locationName
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExportName(): string
    {
        return $this->exportName;
    }

    public function getExportedAt(): DateTimeImmutable
    {
        return $this->exportedAt;
    }

    public function getExportedByUsername(): string
    {
        return $this->exportedByUsername;
    }

    public function getLocationName(): string
    {
        return $this->locationName;
    }
}
