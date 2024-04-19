<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;

class CreateUserController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Throwable
     */
    public function __invoke(CreateUserRequest $request, UserService $userService): UserResource
    {
        $dto = $request->getUserDTO();

        $user = \DB::transaction(fn (): User => $userService->create($dto));

        return UserResource::make($user);
    }
}
