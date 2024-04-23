<?php

declare(strict_types=1);

beforeEach(function (): void {
    \App\Models\User::query()->delete();
});

describe('test create user endpoint', function (): void {
    it('should create an user', function (): void {
        $user = \App\Models\User::factory()->superadmin()->createOne();
        $response = $this->actingAs($user)->postJson('/api/users', [
            'first_name' => fake()->unique()->firstName(),
            'last_name' => fake()->unique()->lastName(),
            'mobile' => fake()->unique()->e164PhoneNumber(),
            'email' => fake()->unique()->email(),
            'username' => fake()->unique()->userName(),
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_CREATED);
    });

    it('should not create when user isn\'t a superadmin', function (): void {
        $user = \App\Models\User::factory()->notSuperadmin()->createOne();
        $response = $this->actingAs($user)->postJson('/api/users', [
            'first_name' => fake()->unique()->firstName(),
            'last_name' => fake()->unique()->lastName(),
            'mobile' => fake()->unique()->e164PhoneNumber(),
            'email' => fake()->unique()->email(),
            'username' => fake()->unique()->userName(),
        ]);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_FORBIDDEN);
    });
});
