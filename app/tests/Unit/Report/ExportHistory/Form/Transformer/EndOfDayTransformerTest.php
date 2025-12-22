<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Tests\Unit\Report\ExportHistory\Form\Transformer;

use DateTimeImmutable;
use LsiSoftwareTask\Report\ExportHistory\Form\Transformer\EndOfDayTransformer;
use PHPUnit\Framework\TestCase;

final class EndOfDayTransformerTest extends TestCase
{
    public function testReverseTransformReturnsNullForInvalidValue(): void
    {
        $transformer = new EndOfDayTransformer();

        $this->assertNull($transformer->reverseTransform(null));
        $this->assertNull($transformer->reverseTransform('2025-02-03'));
    }

    public function testReverseTransformNormalizesToEndOfDay(): void
    {
        $value = new DateTimeImmutable('2025-02-03 00:00:00');
        $transformer = new EndOfDayTransformer();

        $result = $transformer->reverseTransform($value);

        $this->assertInstanceOf(DateTimeImmutable::class, $result);
        $this->assertSame('2025-02-03 23:59:59.999999', $result->format('Y-m-d H:i:s.u'));
    }
}
