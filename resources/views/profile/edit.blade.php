@extends('layouts.app')

@section('title', 'Profil Ayarları')

@section('content')
    <div class="mx-auto max-w-4xl px-4 py-12 sm:px-6 sm:py-16">
        <p class="text-sm font-medium text-fg-brand">@lang('About')</p>
        <h1 class="mt-1 text-3xl font-semibold tracking-tight text-heading sm:text-4xl">@lang('Profile settings')</h1>
        <p class="mt-2 text-sm text-body">@lang('Manage profile information and account security.')</p>

        <div class="mt-8 flex flex-col gap-6">
            {{-- Profil bilgileri --}}
            <form action="{{route('profile.edit')}}" method="post" class="overflow-hidden rounded-2xl border border-default bg-neutral-primary-soft shadow-xs">
                @method('PUT')
                @csrf
                <div class="border-b border-default p-6">
                    <h2 class="font-semibold text-heading">@lang('Profile information')</h2>
                    <p class="mt-1 text-sm text-body">@lang('This information is visible to everyone on your profile page.')</p>
                </div>
                <div class="space-y-5 p-6">
                    <div class="flex items-center gap-5">
                        <x-avatar :initials="$user->getFullNameInitials()" size="lg" />
                        <div class="flex gap-2">
                            <label for="avatar" class="cursor-pointer rounded-base border border-default-medium px-3 py-2 text-sm font-medium text-heading transition hover:bg-neutral-secondary-medium">
                                @lang('Upload photo')
                                <input id="avatar" type="file" accept="image/*" disabled class="hidden">
                            </label>
                            <button type="button" class="rounded-base px-3 py-2 text-sm font-medium text-red-600 transition hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-950/30">@lang('Remove')</button>
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <x-text-input id="firstname" name="firstname" icon="user" label="{{ trans('Name') }}" value="{{$user->firstname}}" />
                        <x-text-input id="lastname" name="lastname" icon="user" label="{{ trans('Surname') }}" value="{{$user->lastname}}" />
                        <x-text-input id="email" name="email" type="email" icon="mail" label="{{ trans('Email') }}" value="{{$user->email}}" />

                    </div>

                    <div>
                        <label for="username" class="mb-2 block text-sm font-medium text-heading">@lang('User Name')</label>
                        <div class="flex">
                            <span class="inline-flex items-center rounded-s-lg border border-e-0 border-default-medium bg-neutral-secondary-medium px-3 text-sm text-body">kalem.com/@</span>
                            <input type="text" id="username" name="username" value="{{$user->username}}"
                                class="block w-full min-w-0 flex-1 rounded-e-lg border border-default-medium bg-neutral-secondary-medium p-2.5 text-sm text-heading focus:border-brand focus:ring-brand">
                        </div>
                    </div>

                    <div>
                        <label for="about" class="mb-2 block text-sm font-medium text-heading">@lang('About')</label>
                        <textarea id="about" name="about" rows="4"
                            class="block w-full rounded-lg border border-default-medium bg-neutral-secondary-medium p-2.5 text-sm text-heading focus:border-brand focus:ring-brand">{{$user->about}}</textarea>
                        <p class="mt-2 text-xs text-body">@lang('Maximum 160 characters.')</p>
                    </div>
                </div>
                <div class="flex justify-end gap-3 border-t border-default bg-neutral-secondary-soft px-6 py-4">
                    <button type="button" class="rounded-base px-4 py-2 text-sm font-medium text-body transition hover:bg-neutral-secondary-medium hover:text-heading">@lang('Cancel')</button>
                    <button type="submit" class="rounded-base bg-brand px-4 py-2 text-sm font-semibold text-white transition hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">@lang('Save changes')</button>
                </div>
            </form>

            {{-- Şifre --}}
            <form action="#" class="overflow-hidden rounded-2xl border border-default bg-neutral-primary-soft shadow-xs">
                <div class="border-b border-default p-6">
                    <h2 class="font-semibold text-heading">@lang('Change password')</h2>
                    <p class="mt-1 text-sm text-body">@lang('Use a strong password for your security.')</p>
                </div>
                <div class="space-y-5 p-6">
                    <x-password-input id="current_password" name="current_password" label="{{trans('Current Password')}}" />
                    <div class="grid gap-5 sm:grid-cols-2">
                        <x-password-input id="new_password" name="password" label="{{trans('New password')}}" autocomplete="new-password" />
                        <x-password-input id="new_password_confirmation" name="password_confirmation" label="{{trans('New password (again)')}}" autocomplete="new-password" />
                    </div>
                </div>
                <div class="flex justify-end border-t border-default bg-neutral-secondary-soft px-6 py-4">
                    <button type="submit" class="rounded-base bg-brand px-4 py-2 text-sm font-semibold text-white transition hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">@lang('Update password')</button>
                </div>
            </form>

            {{-- Tehlikeli alan --}}
            <div class="rounded-2xl border border-red-200 bg-neutral-primary-soft p-6 dark:border-red-900/60">
                <h2 class="font-semibold text-red-700 dark:text-red-400">@lang('Delete account')</h2>
                <p class="mt-1 text-sm text-body">@lang('When you delete your account, all your posts and data will be permanently deleted. This action cannot be undone.')</p>
                <button type="button" data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                    class="mt-4 rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">@lang('Delete my account')</button>
            </div>
        </div>
    </div>

    {{-- Flowbite modal --}}
    <div id="delete-modal" tabindex="-1" aria-hidden="true" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900/50 p-4">
        <div class="w-full max-w-md rounded-2xl border border-default bg-neutral-primary-soft p-6 shadow-xl">
            <h3 class="text-lg font-semibold text-heading">@lang('Are you sure?')</h3>
            <p class="mt-2 text-sm text-body">@lang('Enter your password to continue. Your account will be permanently deleted.')</p>
            <div class="mt-5">
                <x-password-input id="delete_password" name="delete_password" label="{{trans('Password')}}" />
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" data-modal-hide="delete-modal" class="rounded-lg px-4 py-2 text-sm font-medium text-body transition hover:bg-neutral-secondary-medium hover:text-heading">@lang('Give up')</button>
                <button type="button" class="rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">@lang('Yes, delete.')</button>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-toggle-password]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.togglePassword);
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                button.setAttribute('aria-pressed', String(isHidden));
                button.querySelector('[data-icon="show"]').classList.toggle('hidden', isHidden);
                button.querySelector('[data-icon="hide"]').classList.toggle('hidden', !isHidden);
            });
        });
    </script>
@endsection
