<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): \Illuminate\Http\Response
    {
        $request->user()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return \Response::noContent();
    }
}
