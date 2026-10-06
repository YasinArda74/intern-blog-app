<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Yazılar, fikirler ve hikâyeler.">
    <title>@yield('title', 'Anasayfa') · Kalem</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-full flex-col bg-gray-50 font-sans text-gray-900 antialiased dark:bg-gray-950 dark:text-gray-100">
    <header class="sticky top-0 z-40 border-b border-gray-200 bg-white/90 backdrop-blur dark:border-gray-800 dark:bg-gray-900/90">
        <nav class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3 sm:px-6" aria-label="Ana menü">
            <a href="/" class="flex items-center gap-2 text-lg font-semibold text-gray-900 dark:text-white">
                <span class="flex size-9 items-center justify-center rounded-lg bg-indigo-700 text-white">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </span>
                Kalem
            </a>

            <form action="#" role="search" class="hidden flex-1 md:block md:max-w-sm">
                <label for="nav-search" class="sr-only">Yazılarda ara</label>
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                        <svg class="size-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35M17 10.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0Z" />
                        </svg>
                    </div>
                    <input type="search" id="nav-search" name="q" placeholder="Yazılarda ara..."
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-9 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500">
                </div>
            </form>

            <div class="flex items-center gap-2">
                <a href="{{route('posts.create')}}"
                    class="hidden items-center gap-2 rounded-lg bg-indigo-700 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 sm:inline-flex dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">
                    <svg class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Z" />
                    </svg>
                    Yazı yaz
                </a>

                <button type="button" id="user-menu-button" data-dropdown-toggle="user-menu" data-dropdown-placement="bottom-end"
                    class="rounded-full focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800">
                    <span class="sr-only">Kullanıcı menüsünü aç</span>
                    <x-avatar initials="AY" size="sm" />
                </button>

                <div id="user-menu" class="z-50 hidden w-56 divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-200 dark:divide-gray-700 dark:bg-gray-800 dark:ring-gray-700">
                    <div class="px-4 py-3 text-sm">
                        <p class="font-medium text-gray-900 dark:text-white">{{\Illuminate\Support\Facades\Auth::user()->firstname}}</p>
                        <p class="truncate text-gray-500 dark:text-gray-400">{{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="user-menu-button">
                        <li><a href="{{route('showProfil')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Profilim</a></li>
                        <li><a href="{{route('posts.create')}}" class="block px-4 py-2 hover:bg-gray-100 sm:hidden dark:hover:bg-gray-700">Yazı yaz</a></li>
                        <li><a href="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Taslaklarım</a></li>
                        <li><a href="{{route('profilAyarlari')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Ayarlar</a></li>
                    </ul>
                    <div class="py-2">
                        <a href="{{route('logout')}}" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-700">Çıkış yap</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="mt-16 border-t border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-4 py-8 text-sm text-gray-500 sm:flex-row sm:px-6 dark:text-gray-400">
            <p>&copy; 2026 Kalem. Tüm hakları saklıdır.</p>
            <ul class="flex gap-6">
                <li><a href="/" class="hover:text-gray-900 dark:hover:text-white">Anasayfa</a></li>
                <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">Hakkında</a></li>
                <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">İletişim</a></li>
            </ul>
        </div>
    </footer>
</body>
</html>
