<div {{ $attributes->merge([
    'class' => 'bg-white p-6 rounded-2xl border border-gray-200'
]) }}>

    @if($title)
        <div class="flex items-center gap-2 mb-4 text-gray-800 font-semibold">
            @if($icon)
                <x-dynamic-component :component="$icon" class="w-5 h-5 text-indigo-600" />
            @endif
            {{ $title }}
        </div>
    @endif

    {{ $slot }}
</div>