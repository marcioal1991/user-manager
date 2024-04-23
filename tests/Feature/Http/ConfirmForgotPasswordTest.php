<?php

declare(strict_types=1);

afterEach(function (): void {
   \App\Models\PasswordResetToken::query()->delete();
});

beforeEach(function (): void {
    $this->user = \App\Models\User::factory()->create();
    $this->token = Password::createToken($this->user);
});

describe('test confirm reset password endpoint', function (): void {
    it('should return 400 when given email and token not match', function (): void {
        $password = Str::random();
        $response = $this->postJson('/api/confirm-forgot-password', [
            'email' => $this->user->email,
            'password' => $password,
            'confirm_password' => $password,
            'token' => Str::random(),
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_BAD_REQUEST);
    });

    it('should return 422 when given password and confirm password not match', function (): void {
        $response = $this->postJson('/api/confirm-forgot-password', [
            'email' => $this->user->email,
            'password' => '12345678',
            'confirm_password' => '123456789',
            'token' => $this->token,
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it('should return 200 when given a valid email, reset token and password', function (): void {
        $password = Str::random();
        $response = $this->postJson('/api/confirm-forgot-password', [
            'email' => $this->user->email,
            'password' => $password,
            'confirm_password' => $password,
            'token' => $this->token,
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_OK);
    });
});
