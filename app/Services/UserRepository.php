<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\UserDTO;
use App\DTO\UserListDTO;
use App\Http\Requests\Rules\OrderDirection;
use App\Http\Requests\Rules\UserListOrder;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    public function create(UserDTO $dto): User
    {
        $this->sync($dto, $user = new User());

        return $user;
    }

    public function update(UserDTO $dto, User $user): User
    {
        $this->sync($dto, $user);

        return $user;
    }


    public function delete(User $user): void
    {
        $user->delete();
    }

    public function sync(UserDTO $dto, User $user = new User()): void
    {

        $user->username ??= $dto->username;
        $user->mobile ??= $dto->mobile;
        $user->first_name ??= $dto->first_name;
        $user->last_name ??= $dto->last_name;
        $user->email ??= $dto->email;
        $user->password ??= ($dto->password ?? \Str::random());

        $user->save();
    }

    public function filter(UserListDTO $dto): Builder
    {
        return User::query()->when(
            $dto->search !== '',
            fn (Builder $builder): Builder => $builder->where(
                fn (Builder $builder): Builder => $builder->where('first_name', $dto->search)
                    ->orWhere('last_name', $dto->search)
                    ->orWhere('email', $dto->search)
                    ->orWhere('mobile', $dto->search)
                    ->orWhere('username', $dto->search)
            )
        )->when(
            $dto->orderBy !== null,
            fn (Builder $builder): Builder => $builder->orderBy(
                $dto->orderBy->filterValue(),
                $dto->orderDirection?->value ?? OrderDirection::ASCENDING->value,
            ),
            fn (Builder $builder): Builder => $builder->orderBy(
                UserListOrder::ID->value,
                $dto->orderDirection?->value ?? OrderDirection::ASCENDING->value,
            )
        );
    }
}
