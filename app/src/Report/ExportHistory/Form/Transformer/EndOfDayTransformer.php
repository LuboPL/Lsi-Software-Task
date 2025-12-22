<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Form\Transformer;

use DateTimeImmutable;
use DateTimeInterface;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * @implements DataTransformerInterface<DateTimeImmutable|null, DateTimeInterface|null>
 */
final class EndOfDayTransformer implements DataTransformerInterface
{
    public function transform(mixed $value): mixed
    {
        return $value;
    }

    public function reverseTransform(mixed $value): ?DateTimeImmutable
    {
        if ($value === null) {
            return null;
        }

        if (false === $value instanceof DateTimeInterface) {
            return null;
        }

        return DateTimeImmutable::createFromInterface($value)->setTime(23, 59, 59, 999999);
    }
}
