@props(['category'])

@php
    $colors = [
        'bg-sky-100 text-sky-800 dark:bg-sky-900/40 dark:text-sky-200',
        'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/40 dark:text-emerald-200',
        'bg-violet-100 text-violet-800 dark:bg-violet-900/40 dark:text-violet-200',
        'bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-200',
        'bg-rose-100 text-rose-800 dark:bg-rose-900/40 dark:text-rose-200',
        'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/40 dark:text-indigo-200',
    ];
    $color = $colors[hexdec(substr(hash('sha256', $category->slug), 0, 8)) % count($colors)];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex w-fit items-center rounded-full px-2.5 py-1 text-xs font-semibold '.$color]) }}>
    {{ $category->name }}
</span>
