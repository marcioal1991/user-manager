<?php

declare(strict_types=1);

namespace App\DTO;

use App\Http\Requests\Rules\OrderDirection;
use App\Http\Requests\Rules\UserListOrder;

class UserListDTO
{
    public ?string $search = null;
    public ?OrderDirection $orderDirection = null;
    public ?UserListOrder $orderBy = null;
    public ?int $page = null;
    public ?int $size = null;
}
