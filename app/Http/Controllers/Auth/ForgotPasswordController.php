<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use Illuminate\Http\Response;

class ForgotPasswordController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ForgotPasswordRequest $request): \Illuminate\Http\JsonResponse
    {
        $status = \Password::sendResetLink([
            'username' => $request->getUsername(),
        ]);

        if ($status !== \Password::RESET_LINK_SENT) {
            return response()->json(status: Response::HTTP_BAD_REQUEST);
        }

        return response()->json(status: Response::HTTP_OK);
    }
}
