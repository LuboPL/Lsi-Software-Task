<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Tests\Unit\Report\ExportHistory\Validator;

use DateTimeImmutable;
use LsiSoftwareTask\Report\ExportHistory\Criteria\ExportHistoryCriteria;
use LsiSoftwareTask\Report\ExportHistory\Validator\Constraints\ExportHistoryDateRange;
use LsiSoftwareTask\Report\ExportHistory\Validator\Constraints\ExportHistoryDateRangeValidator;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

final class ExportHistoryDateRangeValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator(): ExportHistoryDateRangeValidator
    {
        return new ExportHistoryDateRangeValidator();
    }

    public function testValidWhenMissingDates(): void
    {
        $criteria = new ExportHistoryCriteria();
        $criteria->exportFrom = new DateTimeImmutable('2025-12-10');

        $constraint = new ExportHistoryDateRange();
        $this->validator->validate($criteria, $constraint);

        $this->assertNoViolation();
    }

    public function testValidWhenFromBeforeTo(): void
    {
        $criteria = new ExportHistoryCriteria();
        $criteria->exportFrom = new DateTimeImmutable('2025-12-10');
        $criteria->exportTo = new DateTimeImmutable('2025-12-11');

        $constraint = new ExportHistoryDateRange();
        $this->validator->validate($criteria, $constraint);

        $this->assertNoViolation();
    }

    public function testInvalidWhenFromAfterTo(): void
    {
        $criteria = new ExportHistoryCriteria();
        $criteria->exportFrom = new DateTimeImmutable('2025-12-12');
        $criteria->exportTo = new DateTimeImmutable('2025-12-11');

        $constraint = new ExportHistoryDateRange();
        $this->validator->validate($criteria, $constraint);

        $this->buildViolation($constraint->message)
            ->atPath('property.path.exportFrom')
            ->assertRaised();
    }
}
