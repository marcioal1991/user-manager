<?php

declare(strict_types=1);

namespace App\Http\Requests\Rules;

enum UserListOrder: string
{
    case ID = 'user_id';
    case FIRST_NAME = 'first-name';
    case LAST_NAME = 'last-name';
    case LOGIN_DATE = 'login-date';
    case EMAIL = 'email';
    case DATE_OF_BIRTH  = 'date-of-birth';

    public function filterValue(): string
    {
        return match ($this) {
            self::ID => 'user_id',
            self::FIRST_NAME => 'first_name',
            self::LAST_NAME => 'last_name',
            self::LOGIN_DATE => 'last_logged_in',
            self::EMAIL => 'email',
            self::DATE_OF_BIRTH => 'date_of_birth',
        };
    }
}
