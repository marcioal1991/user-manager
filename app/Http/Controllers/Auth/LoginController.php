<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        if (!\Auth::attempt(['username' => $request->username(), 'password' => $request->password()])) {
            return response()->json(status: Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(status: Response::HTTP_OK);
    }
}
