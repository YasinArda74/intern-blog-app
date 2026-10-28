<?php

use App\Enums\RoleEnum;
use App\Models\Category;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('guests are redirected from the create post page', function () {
    $this->get(route('posts.create'))
        ->assertRedirect(route('login'));
});

test('an author sees the create post form', function () {
    $this->seed(RoleSeeder::class);

    $author = User::factory()->create();
    $author->assignRole(RoleEnum::author->value);
    Category::factory()->create([
        'name' => 'Deneme',
        'slug' => 'deneme',
    ]);

    $this->actingAs($author)
        ->get(route('posts.create'))
        ->assertOk()
        ->assertSee('name="title"', false)
        ->assertSee('name="content"', false)
        ->assertSee('name="excerpt"', false)
        ->assertSee('name="category_slug"', false)
        ->assertSee('name="published_at_feature"', false)
        ->assertSee('value="on"', false)
        ->assertSee('Deneme', false)
        ->assertSee('id="scheduled-date-container" class="mt-4 hidden"', false);
});

test('the create form lists only the first five categories', function () {
    $this->seed(RoleSeeder::class);

    $author = User::factory()->create();
    $author->assignRole(RoleEnum::author->value);

    foreach (['Alpha', 'Bravo', 'Charlie', 'Delta', 'Echo', 'Foxtrot'] as $name) {
        Category::factory()->create(['name' => $name]);
    }

    $this->actingAs($author)
        ->get(route('posts.create'))
        ->assertOk()
        ->assertSee('Alpha', false)
        ->assertSee('Echo', false)
        ->assertDontSee('Foxtrot', false);
});

test('a searched category outside the first five stays selected after validation', function () {
    $this->seed(RoleSeeder::class);

    $author = User::factory()->create();
    $author->assignRole(RoleEnum::author->value);

    foreach (['Alpha', 'Bravo', 'Charlie', 'Delta', 'Echo', 'Foxtrot'] as $name) {
        Category::factory()->create(['name' => $name]);
    }

    $this->actingAs($author)
        ->from(route('posts.create'))
        ->post(route('posts.create'), [
            'category_slug' => 'foxtrot',
        ])
        ->assertRedirect(route('posts.create'));

    $this->get(route('posts.create'))
        ->assertOk()
        ->assertSee('Foxtrot', false);
});

test('category search returns matches for an author', function () {
    $this->seed(RoleSeeder::class);

    $author = User::factory()->create();
    $author->assignRole(RoleEnum::author->value);

    Category::factory()->create(['name' => 'Alpha']);
    Category::factory()->create(['name' => 'Alpine']);
    Category::factory()->create(['name' => 'Bravo']);

    $this->actingAs($author)
        ->getJson(route('posts.categories', ['q' => 'Alp']))
        ->assertOk()
        ->assertExactJson([
            ['value' => 'alpha', 'text' => 'Alpha'],
            ['value' => 'alpine', 'text' => 'Alpine'],
        ]);
});

test('category search does not treat percent as a wildcard', function () {
    $this->seed(RoleSeeder::class);

    $author = User::factory()->create();
    $author->assignRole(RoleEnum::author->value);
    Category::factory()->create(['name' => 'Alpha']);

    $this->actingAs($author)
        ->getJson(route('posts.categories', ['q' => '%']))
        ->assertOk()
        ->assertExactJson([]);
});

test('category search returns 401 when the visitor is signed out', function () {
    $this->getJson(route('posts.categories', ['q' => 'Alpha']))
        ->assertUnauthorized();
});

test('a reader cannot search categories', function () {
    $this->seed(RoleSeeder::class);

    $reader = User::factory()->create();
    $reader->assignRole(RoleEnum::user->value);

    $this->actingAs($reader)
        ->getJson(route('posts.categories', ['q' => 'Alpha']))
        ->assertForbidden();
});

test('category search returns 422 when the query is too long', function () {
    $this->seed(RoleSeeder::class);

    $author = User::factory()->create();
    $author->assignRole(RoleEnum::author->value);

    $this->actingAs($author)
        ->getJson(route('posts.categories', ['q' => str_repeat('a', 101)]))
        ->assertUnprocessable()
        ->assertJsonValidationErrors('q');
});

test('a reader cannot open the create post page', function () {
    $this->seed(RoleSeeder::class);

    $reader = User::factory()->create();
    $reader->assignRole(RoleEnum::user->value);

    $this->actingAs($reader)
        ->get(route('posts.create'))
        ->assertForbidden();
});

test('scheduling without a date keeps the date field visible after validation', function () {
    $this->seed(RoleSeeder::class);

    $author = User::factory()->create();
    $author->assignRole(RoleEnum::author->value);

    $this->actingAs($author)
        ->from(route('posts.create'))
        ->post(route('posts.create'), [
            'published_at_feature' => 'on',
        ])
        ->assertRedirect(route('posts.create'))
        ->assertSessionHasErrors(['title', 'content', 'excerpt', 'category_id', 'scheduled_at']);

    $this->get(route('posts.create'))
        ->assertOk()
        ->assertSee('id="scheduled-date-container" class="mt-4"', false)
        ->assertDontSee('id="scheduled-date-container" class="mt-4 hidden"', false);
});

test('an author can upload an editor image', function () {
    $this->seed(RoleSeeder::class);
    Storage::fake('public');

    $author = User::factory()->create();
    $author->assignRole(RoleEnum::author->value);

    $this->actingAs($author)
        ->post(route('posts.images'), [
            'image' => UploadedFile::fake()->image('photo.jpg'),
        ])
        ->assertOk()
        ->assertJsonStructure(['url']);

    expect(Storage::disk('public')->allFiles('posts'))->toHaveCount(1);
});

test('a text file is rejected as an editor image', function () {
    $this->seed(RoleSeeder::class);
    Storage::fake('public');

    $author = User::factory()->create();
    $author->assignRole(RoleEnum::author->value);

    $this->actingAs($author)
        ->post(route('posts.images'), [
            'image' => UploadedFile::fake()->create('notes.txt', 10, 'text/plain'),
        ])
        ->assertSessionHasErrors('image');

    expect(Storage::disk('public')->allFiles('posts'))->toBeEmpty();
});
