<?php

declare(strict_types=1);

namespace App\Providers;

use App\Policies\Dashboard\MetricsPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PolicyServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Gate::define('canCreateAnUser', [UserPolicy::class, 'create']);
        Gate::define('canUpdateAnUser', [UserPolicy::class, 'update']);
        Gate::define('canDeleteAnUser', [UserPolicy::class, 'delete']);
        Gate::define('canViewAnUser', [UserPolicy::class, 'view']);
        Gate::define('canViewAllUsers', [UserPolicy::class, 'viewAny']);

        Gate::define('canViewDashboardMetrics', [MetricsPolicy::class, 'viewMetrics']);
    }
}
