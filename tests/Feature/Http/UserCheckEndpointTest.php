<?php

declare(strict_types=1);

describe('test of "/api/check" endpoint', function (): void {
    it ('should return 401 status code when has no user logged-in', function (): void {
        $response = $this->getJson('/api/check');

        $response->assertStatus(\Illuminate\Http\Response::HTTP_UNAUTHORIZED);
    });

    it('should return 200 status code when has a user logged-in', function (): void {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)->get('/api/check');

        $response->assertStatus(\Illuminate\Http\Response::HTTP_OK);
    });
});

