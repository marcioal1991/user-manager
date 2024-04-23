<?php

declare(strict_types=1);

beforeEach(function (): void {
    DB::connection('postgres')->table('user')->truncate();

    $this->firstName = fake()->unique()->firstName();
    $this->lastName = fake()->unique()->lastName();
    $this->safeEmail = fake()->unique()->safeEmail();
    $this->userName = fake()->unique()->userName();
    $this->password = Str::random();
    $this->user = \App\Models\User::factory()->state([
        'first_name' => $this->firstName,
        'last_name' => $this->lastName,
        'email' => $this->safeEmail,
        'username' => $this->userName,
        'password' => $this->password,
    ])->create();
});

describe('test user list endpoint and filtering', function (): void {
    it ('should return 200 status code', function (): void {
        $response = $this->actingAs($this->user)->get('/api/users');

        $response->assertStatus(200);
    });

    it ('should return no items and pages', function (): void {
        \App\Models\User::query()->delete();

        $response = $this->actingAs($this->user)->get('/api/users');

        $payload = json_decode($response->getContent(), false);

        expect(count($payload->data))->toBe(0)
            ->and($payload->meta->from)->toBeNull();
    });

    it ('should return only one item and one page', function (): void {
        $response = $this->actingAs($this->user)->get('/api/users');

        $payload = json_decode($response->getContent(), false);

        expect(count($payload->data))->toBe(1)
            ->and($payload->meta->from)->toBe(1);
    });

    it ('should return filter for first_name', function (): void {
        $response = $this->actingAs($this->user)->get(
            sprintf('/api/users?search=%s', $this->user->first_name)
        );

        $payload = json_decode($response->getContent(), false);

        expect(count($payload->data))->toBe(1);
    });

    it ('should return filter for last_name', function (): void {
        $response = $this->actingAs($this->user)->get(
            sprintf('/api/users?search=%s', $this->user->last_name)
        );

        $payload = json_decode($response->getContent(), false);

        expect(count($payload->data))->toBe(1);
    });

    it ('should return filter for email', function (): void {
        $response = $this->actingAs($this->user)->get(
            sprintf('/api/users?search=%s', $this->user->email)
        );

        $payload = json_decode($response->getContent(), false);

        expect(count($payload->data))->toBe(1);
    });

    it ('should return filter for username', function (): void {
        $response = $this->actingAs($this->user)->get(
            sprintf('/api/users?search=%s', $this->user->username)
        );

        $payload = json_decode($response->getContent(), false);

        expect(count($payload->data))->toBe(1);
    });

    it ('should return 4 pages and 25 rows', function (): void {
        \App\Models\User::factory(99)->create();

        $response = $this->actingAs($this->user)->get('/api/users');

        $payload = json_decode($response->getContent(), false);

        expect(count($payload->data))->toBe(25)
            ->and($payload->meta->last_page)->toBe(4);
    });

    it ('should return 2 pages and 50 rows', function (): void {
        \App\Models\User::factory(99)->create();

        $response = $this->actingAs($this->user)->get('/api/users?size=50');

        $payload = json_decode($response->getContent(), false);

        expect(count($payload->data))->toBe(50)
            ->and($payload->meta->last_page)->toBe(2);
    });

    it ('should return 3 pages and 40 rows', function (): void {
        \App\Models\User::factory(99)->create();

        $response = $this->actingAs($this->user)->get('/api/users?size=40');

        $payload = json_decode($response->getContent(), false);

        expect(count($payload->data))->toBe(40)
            ->and($payload->meta->last_page)->toBe(3);
    });

    it ('should return 20 in last page when filtering by 40 rows per page', function (): void {
        \App\Models\User::factory(99)->create();

        $response = $this->actingAs($this->user)->get('/api/users?size=40&page=3');

        $payload = json_decode($response->getContent(), false);

        expect(count($payload->data))->toBe(20)
            ->and($payload->meta->last_page)->toBe(3);
    });

    it ('should return items ordered by user_id in ascending direction', function (): void {
        \App\Models\User::factory(99)->create();

        $response = $this->actingAs($this->user)->get('/api/users');

        $payload = json_decode($response->getContent(), false);
        $order = Arr::pluck($payload->data, 'id');
        $orderToCompare = $order;

        sort($order);

        expect($order === $orderToCompare)->toBeTrue();
    });

    it ('should return items ordered by user_id in descending direction', function (): void {
        \App\Models\User::factory(99)->create();

        $response = $this->actingAs($this->user)->get('/api/users?order_direction=desc');

        $payload = json_decode($response->getContent(), false);
        $order = Arr::pluck($payload->data, 'id');
        $orderToCompare = $order;

        rsort($order);

        expect($order === $orderToCompare)->toBeTrue();
    });

    it ('should return items ordered by first_name in ascending direction', function (): void {
        \App\Models\User::factory(99)->create();

        $response = $this->actingAs($this->user)->get('/api/users?order=first-name');

        $payload = json_decode($response->getContent(), false);

        $order = Arr::pluck($payload->data, 'first_name');
        $orderToCompare = $order;
        sort($order);

        expect($order === $orderToCompare)->toBeTrue();
    });

    it ('should return items ordered by first_name in descending direction', function (): void {
        \App\Models\User::factory(99)->create();

        $response = $this->actingAs($this->user)->get('/api/users?order=first-name&order_direction=desc');

        $payload = json_decode($response->getContent(), false);

        $order = Arr::pluck($payload->data, 'first_name');
        $orderToCompare = $order;
        rsort($order);

        expect($order === $orderToCompare)->toBeTrue();
    });
});
