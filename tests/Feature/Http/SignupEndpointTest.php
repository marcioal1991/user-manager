<?php

declare(strict_types=1);

beforeEach(function (): void {
    $this->user = \App\Models\User::query()->inRandomOrder()->first();
    $this->password = Str::random();

    $currentUsernames = \App\Models\User::query()->pluck('email')->toArray();
    do {
        $this->notExistingEmail = fake()->email();
    } while(in_array($this->notExistingEmail, $currentUsernames));

    $currentUsernames = \App\Models\User::query()->pluck('username')->toArray();
    do {
        $this->notExistingUsername = fake()->userName();
    } while(in_array($this->notExistingUsername, $currentUsernames));

});
describe('test signup endpoint', function (): void {
    it ('should return 422 if username or password is not given in payload', function (): void {
        $response = $this->postJson('/api/login');

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it ('should return 422 no values has given', function (): void {
        $response = $this->postJson('/api/signup');

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it ('should return 422 when a given username already exists', function (): void {
        $user = \App\Models\User::query()->inRandomOrder()->first();
        $password = Str::random();

        $response = $this->postJson('/api/signup', [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'username' => sha1($user->username), // that sha1 hash is just to ensure that the request isn't assert over email too
            'email' => $user->email,
            'password' => $password,
            'confirm_password' => $password,
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it ('should given password is greater or equals a 7 chars', function (): void {
        $response = $this->postJson('/api/signup', [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'username' => $this->notExistingUsername,
            'email' => $this->notExistingEmail,
            'password' => '1234567',
            'confirm_password' => '1234567',
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it ('should give the same confirm_password as a password field', function (): void {
        $response = $this->postJson('/api/signup', [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'username' => $this->notExistingUsername,
            'email' => $this->notExistingEmail,
            'password' => '12345678',
            'confirm_password' => '12345679',
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it ('should user signup successfully', function (): void {
        $response = $this->postJson('/api/signup', [
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'username' => $this->notExistingUsername,
            'email' => $this->notExistingEmail,
            'password' => '12345678',
            'confirm_password' => '12345678',
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_CREATED);
    });
});
