<?php

declare(strict_types=1);

namespace App\DTO;

use Carbon\Carbon;

class UserDTO
{
    public ?string $username = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $mobile = null;
    public ?int $user_id = null;
    public ?string $first_name = null;
    public ?string $last_name = null;
    public ?Carbon $date_of_birth = null;
    public ?Carbon $email_verified_at = null;
    public ?bool $superadmin = null;
    public ?Carbon $last_logged_in = null;
}
