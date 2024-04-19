<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\UserDTO;
use App\Models\User;

class UserService
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

        $user->username = $dto->username;
        $user->mobile = $dto->mobile;
        $user->first_name = $dto->first_name;
        $user->last_name = $dto->last_name;
        $user->email = $dto->email;

        $user->save();
    }
}
