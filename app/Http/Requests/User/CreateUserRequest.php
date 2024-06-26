<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\DTO\UserDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Gate::allows('canCreateAnUser');
    }

    public function rules(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'last_name' => [
                'required',
                'string',
                'min:1',
                'max:255',
            ],
            'mobile' => [
                'nullable',
                'string',
                'max:255',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('user', 'email')
                    ->whereNull('deleted_at')
            ],
            'username' => [
                'required',
                'string',
                'min:1',
                'max:20',
                Rule::unique('user', 'username')
                    ->whereNull('deleted_at')
            ],
        ];
    }

    protected function getFirstName(): string
    {
        return $this->string('first_name')->toString();
    }

    protected function getLastName(): string
    {
        return $this->string('last_name')->toString();
    }

    protected function getMobileNumber(): ?string
    {
        return $this->string('mobile')?->toString();
    }

    protected function getEmail(): string
    {
        return $this->string('email')->toString();
    }

    protected function getUsername(): string
    {
        return $this->string('username')->toString();
    }

    public function getUserDTO(): UserDTO
    {
        $dto = new UserDTO();

        $dto->username = $this->getUsername();
        $dto->mobile = $this->getMobileNumber();
        $dto->first_name = $this->getFirstName();
        $dto->last_name = $this->getLastName();
        $dto->email = $this->getEmail();

        return $dto;
    }
}
