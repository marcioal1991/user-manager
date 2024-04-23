<?php

test('test logout endpoint', function () {
    $user = \App\Models\User::factory(1)->createOne();
    $response = $this->actingAs($user)->postJson('api/logout');

    $response->assertStatus(\Illuminate\Http\Response::HTTP_NO_CONTENT);
});
