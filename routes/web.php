<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

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
