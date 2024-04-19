<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;

class CurrentUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): UserResource
    {
        return UserResource::make(\Auth::user());
    }
}
