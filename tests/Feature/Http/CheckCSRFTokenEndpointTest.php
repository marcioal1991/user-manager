<?php

declare(strict_types=1);

describe('test sanctum csrf-token endpoint', function (): void {
    it('should return 204 status code', function (): void {
        $response = $this->get('/sanctum/csrf-cookie');

        $response->assertNoContent();
    });

    it ('should return a cookie named "XSRF-TOKEN"', function (): void {
        $response = $this->get('/sanctum/csrf-cookie');

        $response->assertCookieNotExpired('XSRF-TOKEN');
    });

    it ('should return a cookie named "XSRF-TOKEN" and it is same that has stored in user session', function (): void {
        $response = $this->get('/sanctum/csrf-cookie');

        $cookie = $response->getCookie('XSRF-TOKEN');
        $token = session()->token();

        expect($cookie->getValue())->toBe($token);
    });
});
