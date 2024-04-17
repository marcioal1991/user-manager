<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ListUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;

class ListUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ListUserRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $users = User::forPage(
            $request->page(),
            $request->rowsPerPage(),
        )->get();

        return UserResource::collection($users);
    }
}
