<?php

declare(strict_types=1);

namespace App\DTO;

use Carbon\Carbon;

class MetricsDaysOverDTO
{
    public ?Carbon $newUsersDaysOver = null;
    public ?Carbon $inactiveUsersDaysOver = null;
    public ?Carbon $deletedUsersDaysOver = null;
}
