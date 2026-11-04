<?php

test('user can successfully create an account', function () {
    $response = $this->postJson('/api/register', [
        'email' => 'john@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertStatus(200);
});


test("test that ",function(){

});