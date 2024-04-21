<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ListUserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\UserRepository;

class ListUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ListUserRequest $request, UserRepository $userRepository): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $dto = $request->getDTO();
        $builder = $userRepository->filter($dto);

        $users = $builder->paginate(
            perPage: $dto->size,
            page: $dto->page,
        );

        return UserResource::collection($users);
    }
}
