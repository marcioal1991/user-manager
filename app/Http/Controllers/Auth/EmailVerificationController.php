<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Response;

class EmailVerificationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(EmailVerificationRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->fulfill();

        return response()->json(status: Response::HTTP_OK);
    }
}
