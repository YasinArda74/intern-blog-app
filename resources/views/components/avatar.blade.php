@props(['initials' => 'AY', 'size' => 'md'])

@php
    $sizes = [
        'sm' => 'size-9 text-sm',
        'md' => 'size-10 text-sm',
        'lg' => 'size-14 text-lg',
        'xl' => 'size-28 text-3xl ring-4 ring-white dark:ring-gray-900',
    ];
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex shrink-0 items-center justify-center rounded-full bg-indigo-100 font-semibold text-indigo-700 dark:bg-indigo-900/60 dark:text-indigo-300 '.($sizes[$size] ?? $sizes['md'])]) }} aria-hidden="true">
    {{ $initials }}
</span>
