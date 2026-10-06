<!DOCTYPE html>
<html lang="tr" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Yazılar, fikirler ve hikâyeler.">

    <title>@yield('title') - {{ config('app.name') }}</title>

    @vite('resources/js/app.js')

    @yield('css')
</head>
<body class="flex min-h-full flex-col bg-gray-50 font-sans text-gray-900 antialiased dark:bg-gray-950 dark:text-gray-100">
    @include('layouts.navbar')

    <main class="flex-1">
        @yield('content')
    </main>

    @include('layouts.footer')

    <script src="{{ asset('js/fontawesome.js') }}"></script>
    @yield('js')
</body>
</html>
