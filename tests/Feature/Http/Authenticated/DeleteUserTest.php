<?php

declare(strict_types=1);

describe('test delete user endpoint', function (): void {
    it ('should delete user when the logged-in user is superadmin', function (): void {
        $user = \App\Models\User::factory()->superadmin()->createOne();
        $user2 = \App\Models\User::factory()->createOne();

        $response = $this->actingAs($user)->deleteJson(sprintf('/api/users/%d', $user2->getKey()));

        $response->assertStatus(\Illuminate\Http\Response::HTTP_NO_CONTENT);
    });

    it ('should allows a superadmin delete an user even when this user is also a superadmin', function (): void {
        $user = \App\Models\User::factory()->superadmin()->createOne();
        $user2 = \App\Models\User::factory()->superadmin()->createOne();

        $response = $this->actingAs($user)->deleteJson(sprintf('/api/users/%d', $user2->getKey()));

        $response->assertStatus(\Illuminate\Http\Response::HTTP_NO_CONTENT);
    });

    it ('shouldn\'t delete a user when the logged-in user isn\'t a superadmin', function (): void {
        $user = \App\Models\User::factory()->notSuperadmin()->createOne();
        $user2 = \App\Models\User::factory()->createOne();

        $response = $this->actingAs($user)->deleteJson(sprintf('/api/users/%d', $user2->getKey()));

        $response->assertStatus(\Illuminate\Http\Response::HTTP_NO_CONTENT);
    });

    it ('shouldn\'t allow deleting a user if the logged-in user is himself and also isn\' a superadmin', function (): void {
        $user = \App\Models\User::factory()->notSuperadmin()->createOne();

        $response = $this->actingAs($user)->deleteJson(sprintf('/api/users/%d', $user->getKey()));

        $response->assertStatus(\Illuminate\Http\Response::HTTP_FORBIDDEN);
    });
});
