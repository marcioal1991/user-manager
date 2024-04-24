<?php

namespace App\Policies\Dashboard;

use App\Policies\BasePolicy;

class MetricsPolicy extends BasePolicy
{
    public function totalActiveUsers(): bool
    {
        return false;
    }

    public function totalInactiveUsers(): bool
    {
        return false;
    }

    public function totalNewUsers(): bool
    {
        return false;
    }
}
