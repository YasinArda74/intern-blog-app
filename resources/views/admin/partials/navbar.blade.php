<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="admin-sidebar" data-drawer-toggle="admin-sidebar" aria-controls="admin-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Menüyü aç</span>
                    <x-admin.icon name="bars" class="w-6 h-6" />
                </button>
                <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24">
                    <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">
                        {{ config('app.name', 'Blog') }} <span class="text-blue-600">Admin</span>
                    </span>
                </a>
            </div>

            <div class="flex items-center">
                <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="user-dropdown">
                    <span class="sr-only">Kullanıcı menüsünü aç</span>
                    <span class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-medium">{{$authUser->getFullNameInitials()}}</span>
                </button>

                <div id="user-dropdown" class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow-sm dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3" role="none">
                        <p class="text-sm text-gray-900 dark:text-white" role="none">{{$authUser->getFullName()}}</p>
                        <p class="text-sm font-medium text-gray-500 truncate dark:text-gray-300" role="none">{{$authUser->email}}</p>
                    </div>
                    <ul class="py-1" role="none">
                        <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">@lang('Panel')</a></li>
                        <li><a href="{{ route('home')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">@lang('View the site')</a></li>
                        <li><a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">@lang('Log Out')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
