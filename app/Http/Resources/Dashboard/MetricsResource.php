<?php

declare(strict_types=1);

namespace App\Http\Resources\Dashboard;

use App\DTO\MetricsDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MetricsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var MetricsDTO $dto */
        $dto = $this->resource;

        return [
            'total_deleted_users' => $dto->totalDeletedUsers,
            'total_inactive_users' => $dto->totalInactiveUsers,
            'total_new_users' => $dto->totalNewUsers,
            'total_active_users' => $dto->totalActiveUsers,
        ];
    }
}
