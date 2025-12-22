<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Tests\Unit\Report\ExportHistory\Criteria;

use DateTimeImmutable;
use LsiSoftwareTask\Report\ExportHistory\Criteria\ExportHistoryCriteria;
use PHPUnit\Framework\TestCase;

final class ExportHistoryCriteriaTest extends TestCase
{
    public function testNormalizeTrimsAndNormalizesValues(): void
    {
        $criteria = new ExportHistoryCriteria();
        $criteria->locationName = 'Katowice';
        $criteria->exportFrom = new DateTimeImmutable('2025-12-10 00:00:00');
        $criteria->exportTo = new DateTimeImmutable('2025-12-11 00:00:00');

        $criteria->normalize();

        $this->assertSame('Katowice', $criteria->locationName);
        $this->assertSame('2025-12-10 00:00:00', $criteria->exportFrom?->format('Y-m-d H:i:s'));
        $this->assertSame('2025-12-11 23:59:59', $criteria->exportTo?->format('Y-m-d H:i:s'));
    }

    public function testNormalizeAllowsNulls(): void
    {
        $criteria = new ExportHistoryCriteria();
        $criteria->normalize();

        $this->assertNull($criteria->locationName);
        $this->assertNull($criteria->exportFrom);
        $this->assertNull($criteria->exportTo);
    }
}
