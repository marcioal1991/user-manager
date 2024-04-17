<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ListUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \Gate::allows('canViewAllUsers');
    }

    public function rules(): array
    {
        return [
            'search' => [
                'nullable',
                'string',
                'max:255',
            ],
            'order' => [

            ],
            'page' => [
                'nullable',
                'integer',
                'min:1',
            ],
            'rows_per_page' => [
                'nullable',
                'integer',
                'min:10',
                'max:100',
            ]
        ];
    }

    public function rowsPerPage(): int
    {
        return $this->integer('rows_per_page', 25);
    }

    public function page(): int
    {
        return $this->integer('page', 1);
    }

    public function search(): ?string
    {
        return $this->string('search')->toString();
    }

    public function order(): string
    {
        return $this->string('order', '')->toString();
    }
}
