<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Hesap') · Kalem</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50 font-sans text-gray-900 antialiased dark:bg-gray-950 dark:text-gray-100">
    <div class="flex min-h-full">
        <aside class="relative hidden w-1/2 flex-col justify-between overflow-hidden bg-indigo-700 p-12 text-white lg:flex">
            <div class="pointer-events-none absolute -right-24 -top-24 size-96 rounded-full bg-indigo-500/40 blur-3xl" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -bottom-32 -left-16 size-96 rounded-full bg-sky-400/30 blur-3xl" aria-hidden="true"></div>

            <a href="/" class="relative flex items-center gap-3 text-lg font-semibold">
                <span class="flex size-10 items-center justify-center rounded-xl bg-white/15 ring-1 ring-white/25">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </span>
                Kalem
            </a>

            <div class="relative max-w-md">
                <h2 class="text-balance text-4xl font-bold leading-tight">@yield('panel-title', 'Tekrar hoş geldin.')</h2>
                <p class="mt-4 text-pretty text-lg leading-relaxed text-indigo-100">
                    @yield('panel-text', 'Yazılarını paylaş, okurlarınla buluş.')
                </p>

                <ul class="mt-10 space-y-4 text-indigo-50">
                    <li class="flex items-center gap-3">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-full bg-white/15">
                            <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        Sade ve odaklı yazı editörü
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-full bg-white/15">
                            <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        Kişisel profil ve yazar sayfası
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="flex size-6 shrink-0 items-center justify-center rounded-full bg-white/15">
                            <svg class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </span>
                        Tüm cihazlarda kusursuz görünüm
                    </li>
                </ul>
            </div>

            <p class="relative text-sm text-indigo-200">&copy; 2026 Kalem. Tüm hakları saklıdır.</p>
        </aside>

        <main class="flex w-full flex-1 flex-col justify-center px-6 py-12 sm:px-12 lg:w-1/2 lg:px-20">
            <div class="mx-auto w-full max-w-md">
                <a href="/" class="mb-10 flex items-center gap-2 text-lg font-semibold text-indigo-700 lg:hidden dark:text-indigo-400">
                    <span class="flex size-9 items-center justify-center rounded-lg bg-indigo-700 text-white">
                        <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </span>
                    Kalem
                </a>

                @yield('content')
            </div>
        </main>
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
</body>
</html>
