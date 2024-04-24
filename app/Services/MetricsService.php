<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\MetricsDaysOverDTO;
use App\Models\User;

class MetricsService
{
    public function activeUsersCount(): int
    {
        return User::query()->active()->count();
    }

    public function inactiveUsersCount(MetricsDaysOverDTO $dto): int
    {
        return User::query()->inactive($dto->inactiveUsersDaysOver)->count();
    }

    public function newUsersCount(MetricsDaysOverDTO $dto): int
    {
        return User::query()->createdInLastIn($dto->newUsersDaysOver)->count();
    }

    public function deletedUsersCount(MetricsDaysOverDTO $dto): int
    {
        return User::query()->deletedInLastIn($dto->deletedUsersDaysOver)->count();
    }
}
