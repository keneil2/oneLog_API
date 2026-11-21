<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\Organization;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('authenticated user can create an organization', function () {
    $user = User::factory()->create();

    $payload = [
        'name' => 'Acme Inc',
        'type' => 'company',
        'billing_address' => '123 Main Street',
    ];

    $response = $this->actingAs($user, 'sanctum')->postJson('/api/organization', $payload);

    $response->assertStatus(201);

    $this->assertDatabaseHas('organizations', [
        ...$payload,
        'logo' => null,
        'owner_id' => $user->id,
    ]);
});




test('authenticated user can create an organization with a logo', function () {
    Storage::fake(config('filesystems.default'));

    $user = User::factory()->create();

    $payload = [
        'name' => 'Acme Inc',
        'type' => 'company',
        'billing_address' => '123 Main Street',
        'logo' => UploadedFile::fake()->image('acme.png'),
    ];

    $response = $this->actingAs($user, 'sanctum')->postJson('/api/organization', $payload);

    $response->assertStatus(201);

    $logoPath = 'logos/' . $payload['logo']->hashName();

    Storage::disk(config('filesystems.default'))->assertExists($logoPath);

    $this->assertDatabaseHas('organizations', [
        'name' => 'Acme Inc',
        'logo' => $logoPath,
        'owner_id' => $user->id,
    ]);
});





test("user can create only one organization", function () {
    $user = User::factory()->create(); 
    Organization::factory()->create();
         $payload = [
        'name' => 'Acme Inc',
        'type' => 'company',
        'billing_address' => '123 Main Street',
    ];

    $response = $this->actingAs($user)->postJson("/api/organization",$payload);
    $response->assertStatus(403);
});





test("unauthenticated user cant create organization", function () {
    $payload = [
        'name' => 'Acme Inc',
        'type' => 'company',
        'billing_address' => '123 Main Street',
        'logo' => 'logos/acme.png',
    ];


    $response = $this->postJson('/api/organization');
    $response->assertStatus(401);

});


