<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Report\ExportHistory\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

final class ExportHistoryDateRange extends Constraint
{
    public string $message = 'Data od nie może być późniejsza niż data do.';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
