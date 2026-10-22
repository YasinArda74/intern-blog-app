<aside id="admin-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Yan menü">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{route('admin.dashboard')}}" @if (($active ?? null) === 'dashboard') aria-current="page" @endif class="group flex items-center p-2 rounded-lg text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 aria-[current=page]:bg-blue-600 aria-[current=page]:text-white aria-[current=page]:hover:bg-blue-600 dark:aria-[current=page]:bg-blue-600 dark:aria-[current=page]:hover:bg-blue-600">
                    <x-admin.icon name="home" class="w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white group-aria-[current=page]:text-white dark:group-aria-[current=page]:text-white" />
                    <span class="ms-3">@lang('Overview')</span>
                </a>
            </li>
            <li>
                <a href="#" @if (($active ?? null) === 'posts') aria-current="page" @endif class="group flex items-center p-2 rounded-lg text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 aria-[current=page]:bg-blue-600 aria-[current=page]:text-white aria-[current=page]:hover:bg-blue-600 dark:aria-[current=page]:bg-blue-600 dark:aria-[current=page]:hover:bg-blue-600">
                    <x-admin.icon name="document" class="w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white group-aria-[current=page]:text-white dark:group-aria-[current=page]:text-white" />
                    <span class="ms-3">@lang('Writings')</span>
                </a>
            </li>
            <li>
                <a href="{{route('categories.getCategories')}}" @if (($active ?? null) === 'categories') aria-current="page" @endif class="group flex items-center p-2 rounded-lg text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 aria-[current=page]:bg-blue-600 aria-[current=page]:text-white aria-[current=page]:hover:bg-blue-600 dark:aria-[current=page]:bg-blue-600 dark:aria-[current=page]:hover:bg-blue-600">
                    <x-admin.icon name="tag" class="w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white group-aria-[current=page]:text-white dark:group-aria-[current=page]:text-white" />
                    <span class="ms-3">@lang('Categories')</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.getUsers')}}" @if (($active ?? null) === 'users') aria-current="page" @endif class="group flex items-center p-2 rounded-lg text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 aria-[current=page]:bg-blue-600 aria-[current=page]:text-white aria-[current=page]:hover:bg-blue-600 dark:aria-[current=page]:bg-blue-600 dark:aria-[current=page]:hover:bg-blue-600">
                    <x-admin.icon name="users" class="w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white group-aria-[current=page]:text-white dark:group-aria-[current=page]:text-white" />
                    <span class="ms-3">@lang('Users')</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.roles.list')}}" @if (($active ?? null) === 'roles') aria-current="page" @endif class="group flex items-center p-2 rounded-lg text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 aria-[current=page]:bg-blue-600 aria-[current=page]:text-white aria-[current=page]:hover:bg-blue-600 dark:aria-[current=page]:bg-blue-600 dark:aria-[current=page]:hover:bg-blue-600">
                    <x-admin.icon name="shield" class="w-5 h-5 text-gray-500 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white group-aria-[current=page]:text-white dark:group-aria-[current=page]:text-white" />
                    <span class="ms-3">@lang('Roles')</span>
                </a>
            </li>
            <li>
                <a href="{{route('admin.getRolAsPermissions')}}" @if (($active ?? null) === 'role-permissions') aria-current="page" @endif class="group flex items-center p-2 rounded-lg text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 aria-[current=page]:bg-blue-600 aria-[current=page]:text-white aria-[current=page]:hover:bg-blue-600 dark:aria-[current=page]:bg-blue-600 dark:aria-[current=page]:hover:bg-blue-600">
                    <i class="fa-solid fa-user-gear text-gray-300 "></i>
                    <span class="ms-3">Rol İzinleri</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
