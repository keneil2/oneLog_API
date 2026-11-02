<?php

declare(strict_types=1);

test('returns 302 when no payload is passed with error messages', function () {
    $response = $this->postJson('/api/login');
    Log::debug($response->json());
    $response->assertStatus(422)
        ->assertExactJson([
            'success' => false,
            'message' => 'Validation errors occurred.',
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

test('returns 401 for invalid user user', function () {
    $response = $this->postJson('/api/login', ["email" => "john@example.com", "password" => "12345"]);
    dd($response->json());
    $response->assertStatus(401);

});
