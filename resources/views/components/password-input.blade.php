@props(['id', 'name', 'label', 'autocomplete' => 'current-password', 'placeholder' => '••••••••'])

<div>
    <div class="mb-2 flex items-center justify-between">
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
        {{ $action ?? '' }}
    </div>
    <div class="relative">
        <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
            <svg class="size-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
        </div>
        <input type="password" id="{{ $id }}" name="{{ $name }}" autocomplete="{{ $autocomplete }}" placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'block w-full rounded-lg border border-gray-300 bg-white p-2.5 ps-10 pe-11 text-sm text-gray-900 focus:border-indigo-600 focus:ring-indigo-600 dark:border-gray-700 dark:bg-gray-900 dark:text-white dark:placeholder-gray-500']) }}>
        <button type="button" data-toggle-password="{{ $id }}" aria-pressed="false" aria-label="Şifreyi göster/gizle"
            class="absolute inset-y-0 end-0 flex items-center rounded-e-lg px-3 text-gray-500 hover:text-gray-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-600 dark:text-gray-400 dark:hover:text-white">
            <svg data-icon="show" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <svg data-icon="hide" class="hidden size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
            </svg>
        </button>
    </div>
</div>
