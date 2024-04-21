<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserRepository;

class UpdateUserController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Throwable
     */
    public function __invoke(User $user, UpdateUserRequest $request, UserRepository $userRepository): UserResource
    {
        $user = \DB::transaction(fn (): User => $userRepository->update($request->getUserDTO(), $user));

        return UserResource::make($user);
    }
}
