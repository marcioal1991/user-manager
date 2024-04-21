<?php

declare(strict_types=1);

namespace App\Http\Requests\Rules;

enum OrderDirection: string
{
    case ASCENDING = 'asc';
    case DESCENDING = 'desc';
}
