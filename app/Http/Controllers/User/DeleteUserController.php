<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\DeleteUserRequest;
use App\Models\User;
use App\Services\UserRepository;

class DeleteUserController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Throwable
     */
    public function __invoke(User $user, DeleteUserRequest $request, UserRepository $userRepository): \Illuminate\Http\Response
    {
        \DB::transaction(fn (): null => $userRepository->delete($user));

        return \Response::noContent();
    }
}
