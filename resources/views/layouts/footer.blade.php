<footer class="mt-16 border-t border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900">
    <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-4 py-8 text-sm text-gray-500 sm:flex-row sm:px-6 dark:text-gray-400">
        <p>&copy; {{ now()->format('Y') . ' ' . config('app.name') }}. @lang('All rights reserved.')</p>
        <ul class="flex gap-6">
            <li><a href="{{ route('home') }}" class="hover:text-gray-900 dark:hover:text-white">@lang('Home Page')</a></li>
            <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">@lang('About')</a></li>
            <li><a href="#" class="hover:text-gray-900 dark:hover:text-white">@lang('Communication')</a></li>
        </ul>
    </div>
</footer>
