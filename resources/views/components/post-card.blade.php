@props([
    'href' => '#',
    'image' => '/images/post-1.png',
    'category' => 'Yazılım',
    'title' => 'Yazı başlığı',
    'excerpt' => '',
    'author' => 'Ahmet Yılmaz',
    'initials' => 'AY',
    'date' => '28 Eylül 2026',
    'readTime' => '5 dk',
])

<article class="group flex flex-col overflow-hidden rounded-xl border border-gray-200 bg-white transition hover:shadow-md dark:border-gray-800 dark:bg-gray-900">
    <a href="{{ $href }}" class="block aspect-[16/9] overflow-hidden bg-gray-100 dark:bg-gray-800">
        <img src="{{ $image }}" alt="" class="size-full object-cover transition duration-300 group-hover:scale-105">
    </a>
    <div class="flex flex-1 flex-col p-5">
        <span class="w-fit rounded-md bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">{{ $category }}</span>
        <h3 class="mt-3 text-lg font-semibold leading-snug text-gray-900 dark:text-white">
            <a href="{{ $href }}" class="hover:text-indigo-700 dark:hover:text-indigo-400">{{ $title }}</a>
        </h3>
        <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-gray-600 dark:text-gray-400">{{ $excerpt }}</p>
        <div class="mt-auto flex items-center gap-3 pt-5">
            <x-avatar :initials="$initials" size="sm" />
            <div class="text-sm">
                <p class="font-medium text-gray-900 dark:text-white">{{ $author }}</p>
                <p class="text-gray-500 dark:text-gray-400">{{ $date }} · {{ $readTime }} okuma</p>
            </div>
        </div>
    </div>
</article>
