<?php

declare(strict_types=1);

describe('ensure that all sanctum protected routes are guarded by middleware', function (): void {
    it('should return 302 status code for all routes when not logged-in', function (): void {
        $routesNamesToEnsure = [
            'logout',
            'api/current-user',
            'api/users.list',
            'api/users.show',
            'api/users.create',
            'api/users.update',
            'api/users.delete',
        ];

        $routes = \Illuminate\Support\Facades\Route::getRoutes();
        /** @var \Illuminate\Routing\Route $route */
        foreach ($routes as $route) {
            if (!in_array($route->getName(), $routesNamesToEnsure)) {
                continue;
            }

            foreach ($route->methods() as $method) {
                $response = match ($method) {
                    'GET' => $this->get($route->uri()),
                    'POST' => $this->post($route->uri()),
                    'PUT' => $this->put($route->uri()),
                    'DELETE' => $this->delete($route->uri()),
                    default => null,
                };

                if ($response === null) {
                    continue;
                }

                $response->assertStatus(\Illuminate\Http\Response::HTTP_FOUND);
            }
        }
    });

    it('should return 200 status code for all routes when user logged-in', function (): void {
        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = \App\Models\User::inRandomOrder()->first();

        $response = $this->actingAs($user)->get('api/user', []);

        $response->assertStatus(\Illuminate\Http\Response::HTTP_OK);
    });
});
