<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Entity;

use DateTimeImmutable;

class ExportHistory
{
    private ?int $id = null;
    private string $exportName;
    private DateTimeImmutable $exportedAt;
    private string $exportedByUsername;
    private string $locationName;

    public function __construct(
        string $exportName,
        DateTimeImmutable $exportedAt,
        string $exportedByUsername,
        string $locationName
    ) {
        $this->exportName = $exportName;
        $this->exportedAt = $exportedAt;
        $this->exportedByUsername = $exportedByUsername;
        $this->locationName = $locationName;
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
