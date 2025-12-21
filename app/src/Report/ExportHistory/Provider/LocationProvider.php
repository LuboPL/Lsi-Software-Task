<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Provider;

use LsiSoftwareTask\Report\ExportHistory\Repository\ExportHistoryReadRepositoryInterface;
use Psr\Cache\InvalidArgumentException;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

final readonly class LocationProvider implements LocationProviderInterface
{
    private const string CACHE_KEY = 'export_history.distinct_locations';
    private const int CACHE_TTL_SECONDS = 3600;

    public function __construct(
        private ExportHistoryReadRepositoryInterface $exportHistoryReadRepository,
        private CacheInterface $cache,
    ) {
    }

    /**
     * @throws InvalidArgumentException
     */
    public function getLocations(): array
    {
        return $this->cache->get(self::CACHE_KEY, function (ItemInterface $item): array {
            $item->expiresAfter(self::CACHE_TTL_SECONDS);

            return $this->exportHistoryReadRepository->getDistinctLocations();
        });
    }
}
