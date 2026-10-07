<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - {{ config('app.name') }}</title>

    @vite('resources/js/app.js')

    @yield('css')
</head>
<body class="h-full bg-gray-50 font-sans text-gray-900 antialiased dark:bg-gray-950 dark:text-gray-100">
<div class="flex min-h-full">
    <aside class="relative hidden w-1/2 flex-col justify-between overflow-hidden bg-indigo-700 p-12 text-white lg:flex">
        <div class="pointer-events-none absolute -right-24 -top-24 size-96 rounded-full bg-indigo-500/40 blur-3xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -bottom-32 -left-16 size-96 rounded-full bg-sky-400/30 blur-3xl" aria-hidden="true"></div>

        <a href="{{ route('home') }}" class="relative flex items-center gap-3 text-lg font-semibold">
                <span class="flex size-10 items-center justify-center rounded-xl bg-white/15 ring-1 ring-white/25">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </span>
            {{ config('app.name') }}
        </a>

        <div class="relative max-w-md">
            <h2 class="text-balance text-4xl font-bold leading-tight">@yield('panel-title')</h2>
            <p class="mt-4 text-pretty text-lg leading-relaxed text-indigo-100">
                @yield('panel-text')
            </p>

            <ul class="mt-10 space-y-4 text-indigo-50">
                <li class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check"></i>
                    @lang('Simple and focused writing editor')
                </li>

                <li class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check"></i>
                    @lang('Personal profile and author page')
                </li>

                <li class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check"></i>
                    @lang('Flawless appearance on all devices')
                </li>
            </ul>
        </div>

        <p>&copy; {{ now()->format('Y') . ' ' . config('app.name') }}. @lang('All rights reserved.')</p>
    </aside>

    <main class="flex w-full flex-1 flex-col justify-center px-6 py-12 sm:px-12 lg:w-1/2 lg:px-20">
        <div class="mx-auto w-full max-w-md">
            <a href="{{ route('home') }}" class="mb-10 flex items-center gap-2 text-lg font-semibold text-indigo-700 lg:hidden dark:text-indigo-400">
                    <span class="flex size-9 items-center justify-center rounded-lg bg-indigo-700 text-white">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </span>
                {{ config('app.name') }}
            </a>

            @yield('content')
        </div>
    </main>
</div>

<script src="{{ asset('js/fontawesome.js') }}"></script>
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
@yield('js')
</body>
</html>
