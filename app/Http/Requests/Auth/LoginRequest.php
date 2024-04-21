<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
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
