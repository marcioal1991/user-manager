<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

class UserPolicy extends BasePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return !($model->isSuperAdmin() && !$user->isSuperAdmin()) || $user->is($model);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return !($model->isSuperAdmin() && !$user->isSuperAdmin()) || $user->is($model);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return !($model->isSuperAdmin() && !$user->isSuperAdmin()) || $user->isNot($model);
    }
}
