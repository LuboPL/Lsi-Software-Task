<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Provider;

interface LocationProviderInterface
{
    public function getLocations(): array;
}
