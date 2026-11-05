<?php

test('the dashboard application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

test('the admin settings page returns a successful response', function () {
    $response = $this->get('/settings');

    $response->assertStatus(200);
    $response->assertSee('Pengaturan Sistem & Ambang Batas');
    $response->assertSee('Kecepatan Angin');
});
