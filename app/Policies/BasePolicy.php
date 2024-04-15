<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

abstract class BasePolicy
{
    /**
     * Create a new policy instance.
     */
    public function before(User $user): ?true
    {
        return $user->isSuperAdmin() ?: null;
    }
}
