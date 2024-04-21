<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserRepository;

class SignupController extends Controller
{
    /**
     * Handle the incoming request.
     * @throws \Throwable
     */
    public function __invoke(SignupRequest $request, UserRepository $userRepository): UserResource
    {
        $dto = $request->getDTO();

        $user = \DB::transaction( fn (): User => $userRepository->create($dto));

        return UserResource::make($user);
    }
}
