<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\DTO\MetricsDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MetricsUsersRequest;
use App\Http\Resources\Dashboard\MetricsResource;
use App\Services\MetricsService;

class MetricsUsersController extends Controller
{
    public function __invoke(MetricsUsersRequest $request, MetricsService $metricsService): MetricsResource
    {
        $requestDto = $request->getDTO();

        $serviceDto = new MetricsDTO();
        $serviceDto->totalActiveUsers = $metricsService->activeUsersCount();
        $serviceDto->totalNewUsers = $metricsService->newUsersCount($requestDto);
        $serviceDto->totalInactiveUsers = $metricsService->inactiveUsersCount($requestDto);
        $serviceDto->totalDeletedUsers = $metricsService->deletedUsersCount($requestDto);

        return MetricsResource::make($serviceDto);
    }
}
