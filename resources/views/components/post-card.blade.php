@props([
    'post',
    'image' => '/images/post-1.png',
])

<article class="group flex flex-col">
    <a href="{{ route('posts.show', $post) }}" class="block aspect-[16/9] overflow-hidden bg-gray-100 dark:bg-gray-800">
        <img src="{{ $image }}" alt="{{ $post->title }}" class="size-full object-cover transition duration-300 group-hover:scale-105">
    </a>

    <div class="flex flex-1 flex-col p-5">
        <span class="w-fit rounded-md bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700 dark:bg-indigo-900/40 dark:text-indigo-300">{{ $category }}</span>

        <h3 class="mt-3 text-lg font-semibold leading-snug text-gray-900 dark:text-white">
            <a href="{{ route('posts.show', $post) }}" class="hover:text-indigo-700 dark:hover:text-indigo-400">{{ $post->title }}</a>
        </h3>

        <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-gray-600 dark:text-gray-400">
            {{ Str::limit($post->content, 100) }}
        </p>

        <div class="mt-4 text-xs text-gray-500">
            {{ $post->created_at->format('d.m.Y') }}
        </div>
    </div>
</article>
