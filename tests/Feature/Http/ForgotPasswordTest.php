<?php

declare(strict_types=1);

describe('test forgot password endpoint', function (): void {
    it ('should return 422 if username not given in payload', function (): void {
        $response = $this->postJson('/api/forgot-password');

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it ('should return 200 when username is provided', function (): void {
        $response = $this->postJson('/api/forgot-password', [
            'username' => \App\Models\User::orderBy('user_id')->first()->username
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_OK);
    });

    it ('should return 400 when username already requested a password reset process', function (): void {
        $response = $this->postJson('/api/forgot-password', [
            'username' => \App\Models\User::orderBy('user_id')->first()->username
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_BAD_REQUEST);
    });
});

afterAll(function (): void {
    \App\Models\PasswordResetToken::query()->delete();
});
