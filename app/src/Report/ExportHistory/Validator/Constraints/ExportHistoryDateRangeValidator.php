<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Validator\Constraints;

use LogicException;
use LsiSoftwareTask\Report\ExportHistory\Dto\ExportHistoryFilterDTO;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class ExportHistoryDateRangeValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if ($value === null) {
            return;
        }

        if (false === $constraint instanceof ExportHistoryDateRange) {
            throw new LogicException('Invalid constraint type.');
        }

        if (false === $value instanceof ExportHistoryFilterDTO) {
            throw new LogicException('Invalid value type.');
        }

        $from = $value->dateFrom;
        $to = $value->dateTo;

        if (!$from || !$to || $from <= $to) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->atPath('dateFrom')
            ->addViolation();
    }
}
