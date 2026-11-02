<?php

test('example', function () {
    $response = $this->postJson('/api/');

    $response->assertStatus(200);
});
