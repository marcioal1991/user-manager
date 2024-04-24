<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\DTO\UserDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignupRequest extends FormRequest
{
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

    protected function firstName(): string
    {
        return $this->string('first_name')->toString();
    }
    protected function lastName(): string
    {
        return $this->string('last_name')->toString();
    }

    protected function email(): string
    {
        return $this->string('email')->toString();
    }

    protected function username(): string
    {
        return $this->string('username')->toString();
    }

    protected function password(): string
    {
        return $this->string('password')->toString();
    }

    public function getDTO(): UserDTO
    {
        $dto = new UserDTO();
        $dto->first_name = $this->firstName();
        $dto->last_name = $this->lastName();
        $dto->email = $this->email();
        $dto->username = $this->username();
        $dto->password = $this->password();

        return $dto;
    }
}
