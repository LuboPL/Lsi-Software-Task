<?php

declare(strict_types=1);

namespace LsiSoftwareTask\Seed;

final class ExportHistorySeedData
{
    /**
     * @var array<int, array{string, string, string, string}>
     */
    public const array ROWS = [
        ['inventory', '2024-12-10 08:15:00', 'system', 'Tychy'],
        ['orders', '2024-12-12 14:05:00', 'admin', 'Katowice'],
        ['clients', '2024-12-14 09:30:00', 'reporter', 'Łódź'],
        ['returns', '2024-12-15 16:45:00', 'system', 'Warszawa'],
        ['payments', '2024-12-18 07:20:00', 'analyst', 'Kraków'],
        ['inventory', '2024-12-14 21:30:00', 'reporter', 'Łódź'],
    ];
}
