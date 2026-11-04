<?php

declare(strict_types=1);
use App\Models\User;

test('returns 302 when no payload is passed with error messages', function () {
    $response = $this->postJson('/api/login');
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
    $response = $this->postJson('/api/login', ['email' => 'john@example.com', 'password' => '12345']);
    $response->assertStatus(401);

});

test('login should be throttle per user and return 429', function () {
    $this->postJson('/api/login', ['email' => 'john@example.com', 'password' => '12345']);
    $this->postJson('/api/login', ['email' => 'john@example.com', 'password' => '12345']);
    $this->postJson('/api/login', ['email' => 'john@example.com', 'password' => '12345']);
    $response = $this->postJson('/api/login', ['email' => 'john@example.com', 'password' => '12345']);
    $response->assertStatus(429);
});

test("succefull login attempt",function(){
     User::factory()->create(["email"=>"test@example.com", "password"=> "secret"]);
     $response = $this->postJson('/api/login', ["email"=>"test@example.com", "password"=> "secret"]);
     $response->assertStatus(200);
});
