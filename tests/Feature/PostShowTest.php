<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the post page renders tiptap content as written', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for($user)->create([
        'title' => 'Sade bir yazi',
        'content' => [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'heading',
                    'attrs' => ['level' => 2],
                    'content' => [
                        ['type' => 'text', 'text' => 'Bolum'],
                    ],
                ],
                [
                    'type' => 'paragraph',
                    'content' => [
                        ['type' => 'text', 'text' => 'Merhaba '],
                        ['type' => 'text', 'marks' => [['type' => 'bold'], ['type' => 'italic']], 'text' => 'dunya'],
                        ['type' => 'text', 'marks' => [['type' => 'link', 'attrs' => ['href' => 'javascript:alert(1)']]], 'text' => 'kotu'],
                        ['type' => 'text', 'marks' => [['type' => 'link', 'attrs' => ['href' => 'https://kalem.test']]], 'text' => 'site'],
                    ],
                ],
                [
                    'type' => 'bulletList',
                    'content' => [
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        ['type' => 'text', 'text' => 'Madde'],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'blockquote',
                    'content' => [
                        [
                            'type' => 'paragraph',
                            'content' => [
                                ['type' => 'text', 'text' => '<script>alert(1)</script>'],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);

    $this->get(route('posts.show', ['user' => $user->username, 'postSlug' => $post->slug]))
        ->assertOk()
        ->assertSee('Sade bir yazi', false)
        ->assertSee('<h2>Bolum</h2>', false)
        ->assertSee('<strong><em>dunya</em></strong>', false)
        ->assertSee('kotu', false)
        ->assertDontSee('javascript:', false)
        ->assertSee('<a href="https://kalem.test">site</a>', false)
        ->assertSee('<li><p>Madde</p></li>', false)
        ->assertSee('&lt;script&gt;alert(1)&lt;/script&gt;', false)
        ->assertDontSee('<script>alert(1)</script>', false)
        ->assertDontSee('Breadcrumb', false)
        ->assertSee(__('Comments'), false)
        ->assertSee(__('Write a comment'), false)
        ->assertSee('Elif Kaya', false)
        ->assertSee('images/post-cover.svg', false)
        ->assertDontSee(__('Edit post'), false);
});

test('only the post owner sees the edit button', function () {
    $owner = User::factory()->create();
    $reader = User::factory()->create();
    $post = Post::factory()->for($owner)->create();

    $this->actingAs($reader)
        ->get(route('posts.show', ['user' => $owner->username, 'postSlug' => $post->slug]))
        ->assertOk()
        ->assertDontSee(__('Edit post'), false);

    $this->actingAs($owner)
        ->get(route('posts.show', ['user' => $owner->username, 'postSlug' => $post->slug]))
        ->assertOk()
        ->assertSee(__('Edit post'), false);
});

test('extended editor content is rendered and unsafe images are dropped', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for($user)->create([
        'content' => [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'attrs' => ['textAlign' => 'center'],
                    'content' => [
                        ['type' => 'text', 'marks' => [['type' => 'highlight']], 'text' => 'vurgu'],
                    ],
                ],
                [
                    'type' => 'image',
                    'attrs' => ['src' => 'https://kalem.test/photo.jpg', 'alt' => 'Kapak'],
                ],
                [
                    'type' => 'image',
                    'attrs' => ['src' => 'javascript:alert(1)', 'alt' => 'kotu'],
                ],
                [
                    'type' => 'taskList',
                    'content' => [
                        [
                            'type' => 'taskItem',
                            'attrs' => ['checked' => true],
                            'content' => [
                                ['type' => 'paragraph', 'content' => [['type' => 'text', 'text' => 'Bitti']]],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'table',
                    'content' => [
                        [
                            'type' => 'tableRow',
                            'content' => [
                                ['type' => 'tableHeader', 'content' => [['type' => 'paragraph', 'content' => [['type' => 'text', 'text' => 'Ad']]]]],
                                ['type' => 'tableCell', 'content' => [['type' => 'paragraph', 'content' => [['type' => 'text', 'text' => 'Kalem']]]]],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);

    $this->get(route('posts.show', ['user' => $user->username, 'postSlug' => $post->slug]))
        ->assertOk()
        ->assertSee('<p style="text-align: center"><mark>vurgu</mark></p>', false)
        ->assertSee('<img src="https://kalem.test/photo.jpg" alt="Kapak">', false)
        ->assertDontSee('javascript:alert', false)
        ->assertSee('data-checked="true"', false)
        ->assertSee('<th><p>Ad</p></th>', false)
        ->assertSee('<td><p>Kalem</p></td>', false);
});

test('plain text stored in content is shown as paragraphs', function () {
    $user = User::factory()->create();
    $post = Post::factory()->for($user)->create([
        'content' => "Ilk paragraf.\n\nIkinci paragraf.",
    ]);

    $this->get(route('posts.show', ['user' => $user->username, 'postSlug' => $post->slug]))
        ->assertOk()
        ->assertSee('<p>Ilk paragraf.</p>', false)
        ->assertSee('<p>Ikinci paragraf.</p>', false);
});
