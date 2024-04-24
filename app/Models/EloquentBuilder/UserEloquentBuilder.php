<?php

declare(strict_types=1);

namespace App\Models\EloquentBuilder;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class UserEloquentBuilder extends Builder
{
    public function active(): self
    {
        return $this;
    }

    public function inactive(Carbon $date): self
    {
        return $this->where(
            fn (self $builder): self =>
                $builder->whereDate('last_logged_in', $date)
                    ->orWhereNull('last_logged_in')
        );
    }

    public function createdInLastIn(Carbon $date): self
    {
        return $this->where(
            fn (self $builder): self =>
                $builder->whereDate('created_at', '>=', $date)
        );
    }

    public function deletedInLastIn(Carbon $date): self
    {
        return $this->onlyTrashed()->where(
            fn (self $builder): self =>
            $builder->whereDate('deleted_at', '>=', $date)
        );
    }
}
