<div class="">
    @if($label)
        <div class="text-sm font-normal text-gray-500">
            {{ $label }}
        </div>
    @endif

    <div class="text-sm font-semibold text-gray-900">
        @if($link)
            <a href="{{ $link }}" class="text-indigo-600 hover:underline font-semibold" target="_blank">
                {{ $value }}
            </a>
        @else
            {{ $value }}
        @endif
    </div>
</div>
