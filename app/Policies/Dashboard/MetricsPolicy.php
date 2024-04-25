<?php

namespace App\Policies\Dashboard;

use App\Policies\BasePolicy;

class MetricsPolicy extends BasePolicy
{
    public function viewMetrics(): bool
    {
        return false;
    }
}
