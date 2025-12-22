<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Tests\Unit\Report\ExportHistory\Provider;

use LsiSoftwareTask\Report\ExportHistory\Provider\LocationProvider;
use LsiSoftwareTask\Report\ExportHistory\Repository\ExportHistoryReadRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

final class LocationProviderTest extends TestCase
{
    public function testReturnsCachedLocations(): void
    {
        $repository = $this->createMock(ExportHistoryReadRepositoryInterface::class);
        $repository->expects($this->once())
            ->method('getDistinctLocations')
            ->willReturn(['Katowice', 'Kraków']);

        $cache = new ArrayAdapter();
        $provider = new LocationProvider($repository, $cache);

        $first = $provider->getLocations();
        $second = $provider->getLocations();
        $third = $provider->getLocations();

        $this->assertSame(['Katowice', 'Kraków'], $first);
        $this->assertSame($first, $second, 'Second call should return cached result');
        $this->assertSame($first, $third, 'Third call should return cached result');
    }
}
