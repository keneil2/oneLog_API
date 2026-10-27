<?php

test('returns 302 when no payload is passed with error messages', function () {
    $response = $this->postJson('/api/login');

    $response->assertStatus(422)
        ->assertExactJson([
            'message' => 'The email field is required. (and 1 more error)',
            'errors' => [
                'email' => [
                    'The email field is required.',
                ],
                'password' => [
                    'The password field is required.',
                ],
            ],
        ]);
});
