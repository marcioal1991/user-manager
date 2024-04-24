<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'string',
                'max:255',
            ],
            'token' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
            ],
            'confirm_password' => [
                'required',
                'string',
                'same:password',
            ]
        ];
    }

    public function getEmail(): string
    {
        return $this->string('email')->toString();
    }

    public function getToken(): string
    {
        return $this->string('token')->toString();
    }

    public function getUserPassword(): string
    {
        return $this->string('password')->toString();
    }

    public function getConfirmUserPassword(): string
    {
        return $this->string('confirm_password')->toString();
    }
}
