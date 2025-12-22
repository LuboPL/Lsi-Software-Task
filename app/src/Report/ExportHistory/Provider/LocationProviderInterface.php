<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Provider;

interface LocationProviderInterface
{
    /**
     * @return array<int, string>
     */
    public function getLocations(): array;
}
