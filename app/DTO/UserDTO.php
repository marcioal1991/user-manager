<?php

declare(strict_types=1);

namespace App\DTO;

use Carbon\Carbon;

class UserDTO
{
    public ?string $username;
    public ?string $email;
    public ?string $password;
    public ?string $mobile;
    public ?int $user_id;
    public ?string $first_name;
    public ?string $last_name;
    public ?Carbon $date_of_birth;
    public ?Carbon $email_verified_at;
    public ?bool $superadmin;
    public ?Carbon $last_logged_in;
}
