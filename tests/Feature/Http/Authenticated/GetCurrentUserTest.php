<?php

declare(strict_types=1);

describe('test current user endpoint', function (): void {
    it('should return the current user logged-in', function (): void {
        $user = \App\Models\User::factory(1)->createOne();
        $response = $this->actingAs($user)->get('/api/user');
        $payload = json_decode($response->getContent(), false);

        expect($payload->data->id)->toBe($user->getKey());
    });

    it('should return 200 status code', function (): void {
        $user = \App\Models\User::factory(1)->createOne();
        $response = $this->actingAs($user)->get('/api/user');

        $response->assertStatus(\Illuminate\Http\Response::HTTP_OK);
    });
});
