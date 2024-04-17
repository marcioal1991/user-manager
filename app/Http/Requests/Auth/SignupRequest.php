<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignupRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('user', 'email')->whereNull('deleted_at')
            ],
            'username' => [
                'required',
                'string',
                'max:20',
                Rule::unique('user', 'username')->whereNull('deleted_at')
            ],
            'password' => [
                'string',
                'min:8',
                'max:255',
            ],
            'confirm_password' => [
                'required',
                'string',
                'same:password',
            ],
        ];
    }

    public function email(): string
    {
        return $this->string('email');
    }

    public function username(): string
    {
        return $this->string('username');
    }

    public function password(): string
    {
        return $this->string('password');
    }
}
