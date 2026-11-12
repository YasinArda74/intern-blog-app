<header
    class="sticky top-0 z-40 border-b border-gray-200 bg-white/90 backdrop-blur dark:border-gray-800 dark:bg-gray-900/90">
    <nav class="mx-auto flex max-w-6xl items-center justify-between gap-3 px-4 py-3 sm:px-6" aria-label="@lang('Main navigation')">
        <!-- Logo -->
        <a href="{{ route('home') }}"
           class="flex items-center gap-2 text-lg font-semibold text-gray-900 dark:text-white">
            <span class="flex size-9 items-center justify-center rounded-lg bg-indigo-700 text-white">
                <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                     aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </span>

            {{ config('app.name') }}
        </a>

        <div class="hidden items-center gap-6 lg:flex">
            <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 transition hover:text-indigo-700 dark:text-gray-200 dark:hover:text-indigo-300">@lang('Home Page')</a>
            <a href="{{ route('home') }}#son-yazilar" class="text-sm font-medium text-gray-700 transition hover:text-indigo-700 dark:text-gray-200 dark:hover:text-indigo-300">@lang('Categories')</a>
            <a href="{{ route('home') }}#hakkinda" class="text-sm font-medium text-gray-700 transition hover:text-indigo-700 dark:text-gray-200 dark:hover:text-indigo-300">@lang('About')</a>
        </div>

        <form action="#" role="search" class="hidden flex-1 xl:block xl:max-w-sm">
            <label for="nav-search" class="sr-only">@lang('Search within posts')</label>

            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                    <i class="fa-solid fa-magnifying-glass text-gray-500 dark:text-gray-400 text-sm"></i>
                </div>

                <input type="search" id="nav-search" name="q" placeholder="{{trans('Search within posts...')}}"
                       class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 ps-9 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-800 dark:text-white dark:placeholder-gray-500">
            </div>
        </form>

        <div class="flex items-center gap-2">
            <div class="w-20 shrink-0 sm:w-36">
                <label for="nav-locale" class="sr-only">@lang('Language')</label>
                <select id="nav-locale" onchange="window.location.href = this.value"
                        class="block w-full rounded-base border border-default-medium bg-neutral-secondary-medium px-1.5 py-2.5 text-xs text-heading shadow-xs focus:border-brand focus:ring-brand sm:px-3 sm:text-sm">
                    <option value="{{ route('lang.switch', 'tr') }}" @selected(app()->getLocale() === 'tr')>Türkçe</option>
                    <option value="{{ route('lang.switch', 'en') }}" @selected(app()->getLocale() === 'en')>English</option>
                </select>
            </div>

            <details class="relative lg:hidden">
                <summary class="flex size-10 cursor-pointer list-none items-center justify-center rounded-lg border border-gray-200 text-gray-700 transition hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-indigo-200 dark:border-gray-700 dark:text-gray-200 dark:hover:bg-gray-800 dark:focus:ring-indigo-900 [&::-webkit-details-marker]:hidden"
                         aria-label="@lang('Toggle navigation menu')">
                    <span class="sr-only">@lang('Toggle navigation menu')</span>
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </summary>
                <div class="absolute end-0 top-full z-50 mt-3 flex w-56 flex-col gap-1 rounded-xl border border-gray-200 bg-white p-2 shadow-lg dark:border-gray-700 dark:bg-gray-800">
                    <a href="{{ route('home') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-indigo-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-indigo-300">@lang('Home Page')</a>
                    <a href="{{ route('home') }}#son-yazilar" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-indigo-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-indigo-300">@lang('Categories')</a>
                    <a href="{{ route('home') }}#hakkinda" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-indigo-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-indigo-300">@lang('About')</a>
                    @guest()
                        <a href="{{ route('register') }}" class="rounded-lg px-3 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-indigo-700 dark:text-gray-200 dark:hover:bg-gray-700 dark:hover:text-indigo-300">@lang('Sign Up')</a>
                    @endguest
                </div>
            </details>

            @auth()
                <button type="button" id="user-menu-button" data-dropdown-toggle="user-menu"
                        data-dropdown-placement="bottom-end"
                        class="rounded-full focus:outline-none focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800">
                    <span class="sr-only">Kullanıcı menüsünü aç</span>

                    <x-avatar :initials="$authUser->getFullNameInitials()" size="sm"/>
                </button>

                <div id="user-menu"
                     class="z-50 hidden w-56 divide-y divide-gray-100 rounded-lg bg-white shadow-lg ring-1 ring-gray-200 dark:divide-gray-700 dark:bg-gray-800 dark:ring-gray-700">
                    <div class="px-4 py-3 text-sm">
                        <p class="font-medium text-gray-900 dark:text-white">{{$authUser->getFullName()}}</p>
                        <p class="truncate text-gray-500 dark:text-gray-400">{{$authUser->email}}</p>
                    </div>

                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{route('profile.show')}}"
                               class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">@lang('My Profile')</a>
                        </li>

                        <li>
                            <a href="{{route('posts.create')}}"
                               class="block px-4 py-2 hover:bg-gray-100 sm:hidden dark:hover:bg-gray-700">@lang('Write something')</a>
                        </li>

                        @auth()
                            @role(\App\Enums\RoleEnum::admin->value)
                                <li>
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">@lang('Dashboard')</a>
                                </li>
                            @endrole
                        @endauth
                    </ul>

                    <div class="py-2">
                        <a href="{{route('logout')}}"
                           class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:text-red-400 dark:hover:bg-gray-700">
                            @lang('Log Out')
                        </a>
                    </div>
                </div>
            @endauth

            @guest()
                <a href="{{ route('login') }}"
                        class="rounded-base border border-transparent bg-brand px-2.5 py-2 text-xs font-medium leading-5 text-white shadow-xs transition hover:bg-brand-strong focus:outline-none focus:ring-4 focus:ring-brand-medium sm:px-3 sm:text-sm">
                    @lang('Sign In')
                </a>

                <a href="{{ route('register') }}"
                        class="hidden rounded-base border border-default bg-neutral-primary-soft px-3 py-2 text-sm font-medium leading-5 text-body shadow-xs transition hover:bg-neutral-secondary-medium hover:text-heading focus:outline-none focus:ring-4 focus:ring-neutral-tertiary-soft sm:inline-flex">
                    @lang('Sign Up')
                </a>
            @endguest
        </div>
    </nav>
</header>
