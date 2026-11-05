<?php

test('the dashboard application returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Pos Pantau Cuaca Pantai Sawarna');
    $response->assertSee('STATUS KAWASAN: WASPADA ANGIN KENCANG');
});

test('the devices page returns a successful response', function () {
    $response = $this->get('/devices');

    $response->assertStatus(200);
    $response->assertSee('Tiang Sensor Pantai Ciantir');
    $response->assertSee('Komputer Posko Kantor Desa');
});

test('the analytics page returns a successful response', function () {
    $response = $this->get('/analytics');

    $response->assertStatus(200);
    $response->assertSee('Grafik');
    $response->assertSee('Riwayat');
});

test('the admin settings page returns a successful response', function () {
    $response = $this->get('/settings');

    $response->assertStatus(200);
    $response->assertSee('Atur Batas Peringatan Cuaca');
    $response->assertSee('Batas Bahaya Angin');
});

test('the admin profile detail page returns a successful response', function () {
    $response = $this->get('/profile');

    $response->assertStatus(200);
    $response->assertSee('Profil Petugas Posko Cuaca');
    $response->assertSee('Ahmad Fauzi');
});
