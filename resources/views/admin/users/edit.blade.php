@extends('layouts.admin', ['active' => 'users'])

@section('title', 'Kullanıcılar')

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('btn-update-user')?.addEventListener('click', () => {
                const form = document.querySelector('#form-update-user');

                form.querySelectorAll('[data-selected-role]').forEach((input) => input.remove());

                form.querySelectorAll('[data-role-checkbox]:checked').forEach((checkbox) => {
                    const selectedRole = document.createElement('input');

                    selectedRole.type = 'hidden';
                    selectedRole.name = 'roles[]';
                    selectedRole.value = checkbox.value;
                    selectedRole.dataset.selectedRole = 'true';
                    form.append(selectedRole);
                });

                submitForm(
                    '#form-update-user',
                    '{{ route('admin.putUsersEdit', $user) }}',
                    'PUT'
                );
            });

            document.getElementById('btn-delete-user')?.addEventListener('click', () => {
                if (!confirm('@lang('Are you sure you want to delete this user?')')) return;

                submitForm(
                    '#user-delete-form',
                    '{{ route('admin.usersDelete', [$user]) }}',
                    'DELETE'
                );
            });
        });
    </script>
@endsection

@section('content')
    <div class="mb-6 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-medium text-fg-brand">@lang('User Information')</p>
            <h1 class="mt-1 text-2xl font-bold text-heading">Kullanıcı ayarları</h1>
            <p class="mt-1 text-sm text-body">Kullanıcı bilgilerini ve hesap işlemlerini yönetin.</p>
        </div>

        <a href="{{ route('admin.getUsers') }}"
           class="inline-flex items-center justify-center rounded-base border border-default-medium bg-neutral-secondary-medium px-4 py-2.5 text-sm font-medium text-body shadow-xs hover:bg-neutral-tertiary-medium hover:text-heading focus:outline-none focus:ring-4 focus:ring-neutral-tertiary">
            <i class="fa-solid fa-arrow-left me-2" aria-hidden="true"></i>
            Kullanıcılara dön
        </a>
    </div>

    <div class="grid max-w-6xl gap-6 lg:grid-cols-[minmax(0,1fr)_20rem]">
        <section class="overflow-hidden rounded-base border border-default bg-neutral-primary-soft shadow-xs">
            <div class="border-b border-default bg-neutral-secondary-soft px-5 py-5 sm:px-6">
                <div class="flex items-center gap-4">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-full bg-brand-soft text-xl font-bold text-fg-brand">
                        {{ $user->getFullNameInitials() }}
                    </div>
                    <div class="min-w-0">
                        <h2 class="truncate text-xl font-semibold text-heading">{{ $user->getFullName() }}</h2>
                        <p class="mt-1 truncate text-sm text-body">Kullanıcı profilini güncelleyin.</p>
                    </div>
                </div>
            </div>

            <form id="form-update-user" class="space-y-5 p-5 sm:p-6">
                @csrf
                @method('PUT')
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="firstname" class="mb-2 block text-sm font-medium text-heading">Ad</label>
                        <input id="firstname"
                               name="firstname"
                               type="text"
                               value="{{ $user->firstname }}"
                               class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3.5 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand">
                    </div>
                    <div>
                        <label for="lastname" class="mb-2 block text-sm font-medium text-heading">Soyad</label>
                        <input id="lastname"
                               name="lastname"
                               type="text"
                               value="{{ $user->lastname }}"
                               class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3.5 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand">
                    </div>
                    <div>
                        <label for="username" class="mb-2 block text-sm font-medium text-heading">Kullanıcı adı</label>
                        <input id="username"
                               name="username"
                               type="text"
                               value="{{ $user->username }}"
                               class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3.5 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand">
                    </div>
                    <div>
                        <label for="email" class="mb-2 block text-sm font-medium text-heading">E-posta</label>
                        <input id="email"
                               name="email"
                               type="email"
                               value="{{ $user->email }}"
                               class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3.5 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand">
                    </div>
                    <div class="sm:col-span-2">
                        <label for="about" class="mb-2 block text-sm font-medium text-heading">Hakkında</label>
                        <textarea id="about"
                                  name="about"
                                  rows="4"
                                  maxlength="160"
                                  class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-3.5 py-2.5 text-sm text-heading shadow-xs placeholder:text-body focus:border-brand focus:ring-brand">{{ $user->about }}</textarea>
                        <p class="mt-2 text-xs text-body">En fazla 160 karakter.</p>
                    </div>
                </div>

                <section class="rounded-base border border-default-medium">
                    <div class="border-b border-default-medium bg-neutral-secondary-soft px-4 py-3">
                        <h3 class="text-sm font-semibold text-heading">Kullanıcı rolleri</h3>
                        <p class="mt-1 text-xs text-body">Birden fazla rol seçebilirsiniz. Hiç rol seçilmezse kullanıcının mevcut rolleri kaldırılır.</p>
                    </div>
                    <div class="grid gap-3 p-4 sm:grid-cols-2">
                        @forelse ($roles as $role)
                            <label for="role-{{ $role->id }}" class="flex cursor-pointer items-start gap-3 rounded-base border border-default-medium bg-neutral-secondary-medium p-4 transition hover:border-brand">
                                <input id="role-{{ $role->id }}"
                                       data-role-checkbox
                                       type="checkbox"
                                       value="{{ $role->id }}"
                                       @checked($user->roles->contains('id', $role->id))
                                       class="mt-0.5 h-4 w-4 rounded border-default-medium bg-neutral-primary-soft text-brand focus:ring-2 focus:ring-brand-medium">
                                <span>
                                    <span class="block text-sm font-medium text-heading">{{ trans($role->name) }}</span>
                                    <span class="mt-1 block text-xs text-body">{{ $role->name }}</span>
                                </span>
                            </label>
                        @empty
                            <p class="text-sm text-body">Sistemde atanabilir bir rol bulunmuyor.</p>
                        @endforelse
                    </div>
                </section>

                <div class="flex justify-end border-t border-default pt-5">
                    <button id="btn-update-user"
                            type="button"
                            class="inline-flex items-center justify-center rounded-base bg-brand px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium">
                        <i class="fa-solid fa-floppy-disk me-2" aria-hidden="true"></i>
                        Değişiklikleri kaydet
                    </button>
                </div>
            </form>
        </section>

        <aside class="h-fit rounded-base border border-danger-subtle bg-danger-soft shadow-xs">
            <div class="border-b border-danger-subtle px-5 py-4">
                <div class="flex items-center gap-3">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-danger-medium text-fg-danger">
                        <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
                    </span>
                    <div>
                        <h2 class="font-semibold text-fg-danger-strong">Tehlikeli alan</h2>
                        <p class="mt-1 text-xs text-fg-danger">Bu işlem geri alınamaz.</p>
                    </div>
                </div>
            </div>

            <div class="p-5">
                <p class="text-sm leading-6 text-fg-danger-strong">
                    <span class="font-semibold">{{ $user->getFullName() }}</span> kullanıcısını kalıcı olarak silmek üzeresiniz.
                </p>

                <form id="user-delete-form" class="mt-5">
                    <button type="button"
                            id="btn-delete-user"
                            class="inline-flex w-full items-center justify-center rounded-base bg-danger px-4 py-2.5 text-sm font-medium text-white shadow-xs hover:bg-danger-strong focus:outline-none focus:ring-4 focus:ring-danger-medium">
                        <i class="fa-solid fa-trash-can me-2" aria-hidden="true"></i>
                        Kullanıcıyı sil
                    </button>
                </form>
            </div>
        </aside>
    </div>
@endsection
