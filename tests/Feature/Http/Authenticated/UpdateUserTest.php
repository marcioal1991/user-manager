<?php

declare(strict_types=1);

beforeEach(function (): void {
    \App\Models\User::query()->delete();
});

describe('test update user endpoint', function (): void {
    it('should update an user', function (): void {
        $user = \App\Models\User::factory()->superadmin()->createOne();
        $user2 = \App\Models\User::factory()->superadmin()->createOne();
        $response = $this->actingAs($user)->putJson(sprintf('/api/users/%d', $user2->getKey()), [
            'first_name' => fake()->unique()->firstName(),
            'last_name' => fake()->unique()->lastName(),
            'mobile' => fake()->unique()->e164PhoneNumber(),
            'email' => fake()->unique()->email(),
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_OK);
    });

    it('should not update when user isn\'t a superadmin', function (): void {
        $user = \App\Models\User::factory()->notSuperadmin()->createOne();
        $user2 = \App\Models\User::factory()->superadmin()->createOne();

        $response = $this->actingAs($user)->putJson(sprintf('/api/users/%d', $user2->getKey()), [
            'first_name' => fake()->unique()->firstName(),
            'last_name' => fake()->unique()->lastName(),
            'mobile' => fake()->unique()->e164PhoneNumber(),
            'email' => fake()->unique()->email(),
            'username' => fake()->unique()->userName(),
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_FORBIDDEN);
    });

    it('should not update when user isn\'t updating himself', function (): void {
        $user = \App\Models\User::factory()->notSuperadmin()->createOne();
        $user2 = \App\Models\User::factory()->notSuperadmin()->createOne();

        $response = $this->actingAs($user)->putJson(sprintf('/api/users/%d', $user2->getKey()), [
            'first_name' => fake()->unique()->firstName(),
            'last_name' => fake()->unique()->lastName(),
            'mobile' => fake()->unique()->e164PhoneNumber(),
            'email' => fake()->unique()->email(),
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_FORBIDDEN);
    });
});
