@props(['action', 'label'])

<button type="button" data-action="{{ $action }}" aria-label="{{ $label }}" title="{{ $label }}"
        {{ $attributes->merge(['class' => 'inline-flex h-8 min-w-8 items-center justify-center rounded-base px-2 text-sm text-body hover:bg-neutral-tertiary-medium hover:text-heading disabled:cursor-not-allowed disabled:opacity-40']) }}>
    {{ $slot }}
</button>
