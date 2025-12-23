<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Tests\Unit\Report\ExportHistory\Validator;

use DateTimeImmutable;
use LsiSoftwareTask\Report\ExportHistory\Form\ExportHistoryFilter;
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
        $filter = new ExportHistoryFilter();
        $filter->exportFrom = new DateTimeImmutable('2025-12-10');

        $constraint = new ExportHistoryDateRange();
        $this->validator->validate($filter, $constraint);

        $this->assertNoViolation();
    }

    public function testValidWhenFromBeforeTo(): void
    {
        $filter = new ExportHistoryFilter();
        $filter->exportFrom = new DateTimeImmutable('2025-12-10');
        $filter->exportTo = new DateTimeImmutable('2025-12-11');

        $constraint = new ExportHistoryDateRange();
        $this->validator->validate($filter, $constraint);

        $this->assertNoViolation();
    }

    public function testInvalidWhenFromAfterTo(): void
    {
        $filter = new ExportHistoryFilter();
        $filter->exportFrom = new DateTimeImmutable('2025-12-12');
        $filter->exportTo = new DateTimeImmutable('2025-12-11');

        $constraint = new ExportHistoryDateRange();
        $this->validator->validate($filter, $constraint);

        $this->buildViolation($constraint->message)
            ->atPath('property.path.exportFrom')
            ->assertRaised();
    }
}
