<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ShowUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class ShowUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ShowUserRequest $request, User $user): UserResource
    {
        return UserResource::make($user);
    }
}
