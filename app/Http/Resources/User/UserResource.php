<?php

declare(strict_types=1);

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var \App\Models\User $user */
        $user = $this->resource;
        return [
            'id' => $user->getKey(),
            'username' => $user->username,
            'first_name' => $user->first_name,
            'email' => $user->email,
            'last_name' => $user->last_name,
            'mobile_number' => $user->mobile,
            'date_of_birth' => $user->date_of_birth?->toDateString(),
            'last_logged_in' => $user->last_logged_in?->toDateString(),
        ];
    }
}
