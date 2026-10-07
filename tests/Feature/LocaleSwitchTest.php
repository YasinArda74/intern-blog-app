<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('navbar renders a language select for english and turkish', function () {
    $response = $this->get(route('home'));

    $response->assertSee('id="nav-locale"', false);
    $response->assertSee(route('lang.switch', 'en'), false);
    $response->assertSee(route('lang.switch', 'tr'), false);
    $response->assertSee('English', false);
    $response->assertSee('Türkçe', false);
});

test('switching the locale translates the homepage', function () {
    $this->get(route('lang.switch', 'tr'))
        ->assertRedirect()
        ->assertSessionHas('locale', 'tr');

    $this->get(route('home'))
        ->assertSee('Fikirlerinizi yazın ve dünyayla paylaşın.', false);
});
