<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'max:255',
            ],
            'password' =>
                'required',
                'string',
                'max:255',
        ];
    }

    public function username(): string
    {
        return $this->string('username')->toString();
    }

    public function password(): string
    {
        return $this->string('password')->toString();
    }
}
