<?php

declare(strict_types=1);

namespace App\DTO;

class MetricsDTO
{
    public int $totalActiveUsers = 0;
    public int $totalInactiveUsers = 0;
    public int $totalNewUsers = 0;
    public int $totalDeletedUsers = 0;
}
