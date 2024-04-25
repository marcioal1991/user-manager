<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard;

use App\DTO\MetricsDaysOverDTO;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class MetricsUsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return \Gate::allows('canViewDashboardMetrics');
    }

    public function rules(): array
    {
        return [
            'new_users_days_over' => [
                'required',
                'integer'
            ],
            'inactive_users_days_over' => [
                'required',
                'integer'
            ],
            'deleted_users_days_over' => [
                'required',
                'integer'
            ],
        ];
    }

    protected function getInactiveUsersDaysOver(): int
    {
        return $this->integer('inactive_users_days_over');
    }

    protected function getNewUsersDaysOver(): int
    {
        return $this->integer('new_users_days_over');
    }

    protected function getDeletedUsersDaysOver(): int
    {
        return $this->integer('new_users_days_over');
    }

    public function getDTO(): MetricsDaysOverDTO
    {
        $dto = new MetricsDaysOverDTO();
        $dto->newUsersDaysOver = Carbon::today()->subDays($this->getNewUsersDaysOver());
        $dto->inactiveUsersDaysOver = Carbon::today()->subDays($this->getInactiveUsersDaysOver());
        $dto->deletedUsersDaysOver = Carbon::today()->subDays($this->getDeletedUsersDaysOver());

        return $dto;
    }
}
