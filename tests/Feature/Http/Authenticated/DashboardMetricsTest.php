<?php

describe('test metrics endpoint', function (): void {
    it('should only superadmin can see metrics', function (): void {
        $user = \App\Models\User::factory()->superadmin()->create();
        $response = $this->actingAs($user)->get(
            vsprintf('/api/users/metrics?%s&%s&%s', [
                'new_users_days_over=30',
                'deleted_users_days_over=30',
                'inactive_users_days_over=7',
            ])
        );

        $response->assertStatus(\Illuminate\Http\Response::HTTP_OK);
    });

    it('shouldn\'t allows no superadmin users to see', function (): void {
        $user = \App\Models\User::factory()->notSuperadmin()->create();
        $response = $this->actingAs($user)->get(
            vsprintf('/api/users/metrics?%s&%s&%s', [
                'new_users_days_over=30',
                'deleted_users_days_over=30',
                'inactive_users_days_over=7',
            ])
        );

        $response->assertStatus(\Illuminate\Http\Response::HTTP_FORBIDDEN);
    });

    it('should return the metrics count for new, deleted, inactive and active users', function (): void {
        $user = \App\Models\User::factory()->superadmin()->create();
        $response = $this->actingAs($user)->get(
            vsprintf('/api/users/metrics?%s&%s&%s', [
                'new_users_days_over=30',
                'deleted_users_days_over=30',
                'inactive_users_days_over=7',
            ])
        );

        $payload = json_decode($response->getContent(), false);

        expect($payload->data->total_deleted_users)->toBeInt()
            ->and($payload->data->total_deleted_users)->toBeGreaterThanOrEqual(0)
            ->and($payload->data->total_inactive_users)->toBeInt()
            ->and($payload->data->total_inactive_users)->toBeGreaterThanOrEqual(0)
            ->and($payload->data->total_new_users)->toBeInt()
            ->and($payload->data->total_new_users)->toBeGreaterThanOrEqual(0)
            ->and($payload->data->total_active_users)->toBeInt()
            ->and($payload->data->total_active_users)->toBeGreaterThanOrEqual(0);
    });

    it('should return correct count of metrics for new, deleted, inactive and active users', function (): void {
        $user = \App\Models\User::factory()->superadmin()->create();

        $newUsersDays = 30;
        $deletedUsersDays = 30;
        $inactiveUsersDays = 7;

        $response = $this->actingAs($user)->get(
            vsprintf('/api/users/metrics?%s&%s&%s', [
                sprintf('new_users_days_over=%d', $newUsersDays),
                sprintf('deleted_users_days_over=%d', $deletedUsersDays),
                sprintf('inactive_users_days_over=%d', $inactiveUsersDays),
            ])
        );

        $newUsersDaysTotal = \App\Models\User::query()->createdInLastIn(\Carbon\Carbon::today()->subDays($newUsersDays))->count();
        $deletedUsersDaysTotal = \App\Models\User::query()->deletedInLastIn(\Carbon\Carbon::today()->subDays($deletedUsersDays))->count();
        $inactiveUsersTotal = \App\Models\User::query()->inactive(\Carbon\Carbon::today()->subDays($inactiveUsersDays))->count();
        $activeUsersTotal = \App\Models\User::query()->active()->count();

        $payload = json_decode($response->getContent(), false);

        expect($payload->data->total_deleted_users)->toEqual($deletedUsersDaysTotal)
            ->and($payload->data->total_inactive_users)->toEqual($inactiveUsersTotal)
            ->and($payload->data->total_new_users)->toEqual($newUsersDaysTotal)
            ->and($payload->data->total_active_users)->toEqual($activeUsersTotal);
    });
});
