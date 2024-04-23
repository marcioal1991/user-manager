<?php

declare(strict_types=1);

describe('test login endpoint', function (): void {
    it ('should return 422 if username or password is not given in payload', function (): void {
        $response = $this->postJson('/api/login');

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it ('should return 422 if username or password is given in payload but has no values', function (): void {
        $response = $this->postJson('/api/login', [
            'username' => null,
            'password' => null,
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it ('should return 422 if username or password is given in payload but the values are blank', function (): void {
        $response = $this->postJson('/api/login', [
            'username' => '',
            'password' => '',
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNPROCESSABLE_ENTITY);
    });

    it ('should return 401 if username or password is wrong', function (): void {

        $usernames = \App\Models\User::pluck('username')->toArray();

        do {
            $testUsername = Str::random();
        } while (in_array($testUsername, $usernames));

        $response = $this->postJson('/api/login', [
            'username' => $testUsername,
            'password' => Str::random(),
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNAUTHORIZED);
    });

    it ('should return 200 when a user authenticate successfully', function (): void {
        $password = Str::random();
        $user = \App\Models\User::factory()->state([
            'password' => $password,
        ])->create();

        $response = $this->postJson('/api/login', [
            'username' => $user->username,
            'password' => $password,
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_OK);
    });
});
