<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Response;

class ResetPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ResetPasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        $status = \Password::reset([
            'email' => $request->getEmail(),
            'password' => $request->getUserPassword(),
            'password_confirmation' => $request->getConfirmUserPassword(),
            'token' => $request->getToken(),
        ], function (User $user, string $password) {
            $user->password = $password;
            $user->save();

            event(new PasswordReset($user));
        });

        if ($status !== \Password::PASSWORD_RESET) {
            return response()->json(status: Response::HTTP_BAD_REQUEST);
        }

        return response()->json(status: Response::HTTP_OK);
    }
}
