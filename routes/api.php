<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware([])->group(function (): void {
    Route::post('login', [
        \App\Http\Controllers\Auth\LoginController::class
    ]);

    Route::post('signup', [
        \App\Http\Controllers\Auth\SignupController::class
    ]);

    Route::post('forgot-password', [
        \App\Http\Controllers\Auth\ForgotPasswordController::class
    ]);

    Route::post('confirm-forgot-password', [
        \App\Http\Controllers\Auth\ConfirmForgotPasswordController::class
    ]);

    Route::middleware(['auth', 'signed'])->get('email-verification/{id}/{hash}', [
        \App\Http\Controllers\Auth\EmailVerificationController::class
    ])->name('verification.verify');
});

Route::middleware(['auth:sanctum', \App\Http\Middleware\EnsureLastActionUpdate::class])->group(function (): void {
    Route::post('logout', [
        \App\Http\Controllers\Auth\LogoutController::class
    ]);

    Route::get('/user', [
        \App\Http\Controllers\User\CurrentUserController::class
    ]);

    Route::prefix('/users')->group(function (): void {
        Route::get('/', [
            \App\Http\Controllers\User\ListUserController::class,
        ]);

        Route::prefix('{user_id}')->group(function (): void {
            Route::get('/', [
                \App\Http\Controllers\User\ShowUserController::class,
            ]);

            Route::post('/', [
                \App\Http\Controllers\User\CreateUserController::class,
            ]);

            Route::put('/', [
                \App\Http\Controllers\User\UpdateUserController::class,
            ]);

            Route::delete('/', [
                \App\Http\Controllers\User\DeleteUserController::class,
            ]);
        });
    });

});



