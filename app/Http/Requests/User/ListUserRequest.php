<?php

declare(strict_types=1);

namespace App\Http\Requests\User;

use App\DTO\UserListDTO;
use App\Http\Requests\Rules\OrderDirection;
use App\Http\Requests\Rules\UserListOrder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'order_by' => [
                'nullable',
                Rule::enum(UserListOrder::class),
            ],
            'page' => [
                'nullable',
                'integer',
                'min:1',
            ],
            'size' => [
                'nullable',
                'integer',
                'min:10',
                'max:100',
            ]
        ];
    }

    protected function size(): int
    {
        return $this->integer('size', 25);
    }

    protected function page(): int
    {
        return $this->integer('page', 1);
    }

    protected function search(): ?string
    {
        return $this->string('search')->toString();
    }

    protected function orderBy(): ?UserListOrder
    {
        return $this->enum('order_by', UserListOrder::class);
    }

    protected function orderDirection(): ?OrderDirection
    {
        return $this->enum('order_direction', OrderDirection::class);
    }

    public function getDTO(): UserListDTO
    {
        $dto = new UserListDTO();

        $dto->size = $this->size();
        $dto->orderBy = $this->orderBy();
        $dto->orderDirection = $this->orderDirection();
        $dto->page = $this->page();
        $dto->search = $this->search();

        return $dto;
    }
}
