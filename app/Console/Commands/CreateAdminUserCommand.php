<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

#[Signature('app:create-admin-user')]
#[Description('Creates an admin user')]
class CreateAdminUserCommand extends Command
{
    public function handle(): void
    {
        $username = $this->ask('Username?');
        $firstName = $this->ask('First Name?');
        $lastName = $this->ask('Last Name?');
        $email = $this->ask('Email?');
        $password = $this->ask('Password?');

        $user = User::query()->create([
            'username' => $username,
            'firstname' => $firstName,
            'lastname' => $lastName,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $user->assignRole(RoleEnum::admin->value);
    }
}
