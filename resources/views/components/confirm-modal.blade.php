@props(['id', 'title' => 'Konfirmasi', 'message' => null, 'cancelText' => 'Batal', 'variant' => 'danger'])

@php
    $colors = [
        'danger' => 'text-red-600 bg-red-500/10',
        'primary' => 'text-blue-600 bg-blue-500/10',
    ];
@endphp

<div x-data="{ open: false }" x-cloak x-show="open" x-transition.opacity
    x-on:open-confirm.window="
        if ($event.detail.id === '{{ $id }}') open = true
    "
    x-on:keydown.escape.window="open = false" class="fixed inset-0 z-50 flex items-center justify-center ">

    {{-- BACKDROP --}}
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="open = false">
    </div>

    {{-- MODAL BOX --}}
    <div x-transition.scale
        class="relative bg-white rounded-2xl shadow-2xl
               w-[85vw] sm:w-[85vw] md:max-w-md
               p-6">

        {{-- ICON --}}
        <div class="flex justify-center mb-4">
            <div class="w-12 h-12 flex items-center justify-center rounded-full {{ $colors[$variant] }}">
                <x-heroicon-o-exclamation-triangle class="w-6 h-6" />
            </div>
        </div>

        {{-- TITLE --}}
        <h3 class="text-lg font-semibold text-center text-gray-800">
            {{ $title }}
        </h3>

        {{-- DEFAULT MESSAGE (optional) --}}
        @if ($message)
            <p class="text-sm text-center text-gray-600 mb-2">
                {{ $message }}
            </p>
        @endif
        {{-- SLOT CONTENT --}}
        <div class="text-center mb-5 text-sm text-gray-600 leading-relaxed">
            {{ $slot }}
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex justify-center items-center gap-3">

            {{-- CANCEL --}}
            <button type="button" @click="open = false"
                class="px-4 py-1.5 rounded-lg text-sm
               bg-gray-100 text-gray-700
               hover:bg-gray-200 transition">
                {{ $cancelText }}
            </button>

            {{-- CONFIRM --}}
            <button type="submit" form="delete-form-{{ $id }}"
                class="px-4 py-1.5 rounded-lg text-sm
               bg-red-600 text-white
               hover:bg-red-700 transition">
                Ya, Hapus
            </button>

        </div>

    </div>
</div>
