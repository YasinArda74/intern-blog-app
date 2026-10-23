<?php

use App\Enums\RoleEnum;
use App\Models\User;
use Database\Seeders\RoleSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

test('an admin stores only the permissions marked active', function () {
    $this->seed(RoleSeeder::class);

    Permission::findOrCreate('posts.create');
    Permission::findOrCreate('posts.show');

    $admin = User::factory()->create();
    $admin->assignRole(RoleEnum::admin->value);

    $this->actingAs($admin)
        ->post(route('admin.roles.create'), [
            'name' => 'editor',
            'permissions' => [
                'posts.create' => '1',
                'posts.show' => '0',
            ],
        ])
        ->assertOk()
        ->assertJsonPath('status', true)
        ->assertJsonPath('redirect', route('admin.roles.list'));

    $role = Role::findByName('editor');

    expect($role->permissions->pluck('name')->all())->toBe(['posts.create']);
});

test('updating a role removes permissions marked passive', function () {
    $this->seed(RoleSeeder::class);

    Permission::findOrCreate('posts.create');
    Permission::findOrCreate('posts.show');

    $admin = User::factory()->create();
    $admin->assignRole(RoleEnum::admin->value);

    $role = Role::create(['name' => 'editor']);
    $role->givePermissionTo('posts.show');

    $this->actingAs($admin)
        ->put(route('admin.roles.update', $role), [
            'name' => 'editor',
            'permissions' => [
                'posts.create' => '1',
                'posts.show' => '0',
            ],
        ])
        ->assertRedirect(route('admin.roles.list'));

    expect($role->fresh()->permissions->pluck('name')->all())->toBe(['posts.create']);
});
