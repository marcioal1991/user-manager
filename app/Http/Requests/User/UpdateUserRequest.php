<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Gate::allows('canUpdateAnUser', $this->route('user'));
    }

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
            ],
            'email' => [
                'required',
                'string',
                'email',
                Rule::exists('user', 'email')
                    ->whereNull('deleted_at')
            ],
        ];
    }

    public function getFirstName(): \Stringable
    {
        return $this->string('first_name');
    }

    public function getLastName(): \Stringable
    {
        return $this->string('last_name');
    }

    public function getMobileNumber(): ?\Stringable
    {
        return $this->string('mobile');
    }

    public function getEmail(): ?\Stringable
    {
        return $this->string('email');
    }
}
