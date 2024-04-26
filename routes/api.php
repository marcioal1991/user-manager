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

Route::middleware(['web'])->group(function (): void {
    Route::get('check', \App\Http\Controllers\Auth\CheckLoggedInController::class);
    Route::post('login', \App\Http\Controllers\Auth\LoginController::class)->name('login');
    Route::post('signup',\App\Http\Controllers\Auth\SignupController::class);
    Route::post('forgot-password', \App\Http\Controllers\Auth\ForgotPasswordController::class);
    Route::post('confirm-forgot-password/', \App\Http\Controllers\Auth\ResetPasswordController::class)->name('password.reset');

    Route::middleware(['signed'])->get(
        'email-verification/{id}/{hash}',
        \App\Http\Controllers\Auth\EmailVerificationController::class,
    )->name('verification.verify');
});

Route::middleware(['auth:sanctum', \App\Http\Middleware\EnsureLastActionUpdate::class])->group(function (): void {
    Route::post('/logout', \App\Http\Controllers\Auth\LogoutController::class)->name('logout');
    Route::get('/user', \App\Http\Controllers\User\CurrentUserController::class)->name('current-user');

    Route::prefix('/users')->group(function (): void {
        Route::get('/metrics', \App\Http\Controllers\Dashboard\MetricsUsersController::class)->name('users.metrics');
        Route::get('/', \App\Http\Controllers\User\ListUserController::class)->name('users.list');
        Route::post('/', \App\Http\Controllers\User\CreateUserController::class)->name('users.create');
        Route::prefix('{user}')->group(function (): void {
            Route::get('/', \App\Http\Controllers\User\ShowUserController::class)->name('users.show');
            Route::put('/', \App\Http\Controllers\User\UpdateUserController::class)->name('users.update');
            Route::delete('/', \App\Http\Controllers\User\DeleteUserController::class)->name('users.delete');
        });
    });
});
