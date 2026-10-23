<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Yönetim Paneli') | {{ config('app.name', 'Blog') }}</title>
    @vite('resources/js/app.js')
</head>
<body class="bg-gray-50 dark:bg-gray-900">

    @include('admin.partials.navbar')
    @include('admin.partials.sidebar', ['active' => $active ?? null])

    <main class="p-4 md:ml-64 pt-20 min-h-screen">
        <div class="p-4 mt-2">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('js/fontawesome.js') }}"></script>
    <script>
        // Silme modalında seçilen kaydın adını gösterir (sadece arayüz).
        document.addEventListener('click', function (event) {
            const trigger = event.target.closest('[data-delete-name]');
            if (!trigger) return;
            document.querySelectorAll('[data-delete-target]').forEach(function (el) {
                el.textContent = trigger.dataset.deleteName;
            });
        });
    </script>
    @stack('scripts')
    @yield('js')
</body>
</html>
