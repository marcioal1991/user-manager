<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => [
                'required',
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

    public function getUsername(): string
    {
        return $this->string('username')->toString();
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
