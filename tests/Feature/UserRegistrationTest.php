<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;

test('user can successfully create an account', function () {
    Event::fake();

    $response = $this->postJson('/api/register', [
        'email' => 'john@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertStatus(201);

    $this->assertDatabaseHas(User::class, [
        'email' => 'john@example.com',
    ]);

    Event::assertDispatched(Registered::class, function (Registered $event) {
        return $event->user->email === 'john@example.com';
    });
});

test('verification email is sent when a user registers', function () {
    Notification::fake();

    $this->postJson('/api/register', [
        'email' => 'john2@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $user = User::where('email', 'john2@example.com')->first();

    Notification::assertSentTo($user, VerifyEmail::class);
});
