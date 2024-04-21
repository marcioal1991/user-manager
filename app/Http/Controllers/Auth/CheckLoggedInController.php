<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckLoggedInController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            status: \Auth::check() ? Response::HTTP_OK : Response::HTTP_UNAUTHORIZED,
        );
    }
}
