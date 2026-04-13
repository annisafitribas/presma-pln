@props([
    'type' => 'mobile', // mobile | desktop | mobile-card | desktop-table
])

{{-- MOBILE WRAPPER --}}
@if ($type === 'mobile')
    <div class="md:hidden w-[90%] mx-auto relative">
        {{ $slot }}
    </div>

    {{-- DESKTOP WRAPPER --}}
@elseif ($type === 'desktop')
    <div class="hidden md:block relative">
        {{ $slot }}
    </div>

    {{-- MOBILE CARD --}}
@elseif ($type === 'mobile-card')
    <div class="md:hidden w-[90%] mx-auto relative">
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
            {{ $slot }}
        </div>
    </div>

    {{-- DESKTOP TABLE --}}
@elseif ($type === 'desktop-table')
    <div class="hidden md:block relative">
        <div class="-mx-6 overflow-x-auto">
            <div class="min-w-[800px] px-6">
                {{ $slot }}
            </div>
        </div>
    </div>
@endif
